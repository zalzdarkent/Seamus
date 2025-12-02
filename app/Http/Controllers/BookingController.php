<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    private function getAllowedTimeSlots()
    {
        $slots = [];
        for ($hour = 8; $hour <= 21; $hour++) {
            $slots[] = sprintf('%02d:00', $hour);
        }
        return $slots;
    }
    public function create($id)
    {
        // Ambil data ruangan berdasarkan ID
        $rooms = Room::find($id);

        // Kirim data ruangan ke view
        return view('booking', compact('rooms'));
    }

    public function booking(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,14|numeric',
            'date' => 'required|date|after_or_equal:' . now()->toDateString(),
            'start_time' => ['required', 'string', Rule::in($this->getAllowedTimeSlots())], // Validasi berdasarkan opsi dropdown
            'end_time' => ['required', 'string', Rule::in($this->getAllowedTimeSlots()), 'after:start_time'],
        ]);

        // Mengambil harga per jam dari tabel Room
        $room = Room::find($validated['room_id']);
        $pricePerHour = $room->price_per_hour;

        // Menghitung durasi antara start_time dan end_time dalam menit
        $startTime = Carbon::parse($validated['start_time']);
        $endTime = Carbon::parse($validated['end_time']);
        $durationInMinutes = $startTime->diffInMinutes($endTime);

        // Menghitung durasi dalam jam
        $durationInHours = $durationInMinutes / 60;

        // Menghitung total_amount berdasarkan durasi
        $totalAmount = $pricePerHour * $durationInHours;

        // Transaksi database
        DB::beginTransaction();

        try {
            // Cek apakah ruangan sudah dibooking pada waktu tersebut
            $existingBooking = Booking::where('room_id', $validated['room_id'])
                ->where('date', $validated['date'])
                ->where(function ($query) use ($startTime, $endTime) {
                    $query->whereBetween('start_time', [$startTime, $endTime])
                        ->orWhereBetween('end_time', [$startTime, $endTime])
                        ->orWhere(function ($query) use ($startTime, $endTime) {
                            $query->where('start_time', '<', $startTime)
                                ->where('end_time', '>', $endTime);
                        });
                })
                ->exists();

            if ($existingBooking) {
                return redirect()->back()->with('error', 'Ruangan sudah dibooking pada waktu tersebut.');
            }

            // Simpan booking ke database
            $booking = new Booking();
            $booking->room_id = $validated['room_id'];
            $booking->name = $validated['name'];
            $booking->phone = $validated['phone'];
            $booking->date = $validated['date'];
            $booking->total_amount = $totalAmount;
            $booking->start_time = $validated['start_time'];
            $booking->end_time = $validated['end_time'];
            $booking->status = 'Unpaid';
            $booking->save();

            // Commit transaksi
            DB::commit();

            Log::info('Starting Midtrans configuration...');
            
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => 'BOOK-' . $booking->id,
                    'gross_amount' => (int)$totalAmount, // Convert to integer
                ],
                'customer_details' => [
                    'first_name' => $validated['name'],
                    'phone' => $validated['phone'],
                ],
            ];

            // Log the request parameters
            Log::info('Midtrans Request Parameters:', $params);
            Log::info('Midtrans Server Key:', ['key' => config('midtrans.server_key')]);

            try {
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                Log::info('Midtrans Snap Token generated successfully:', ['token' => $snapToken]);
                return view('checkout', compact('snapToken', 'booking', 'room'));
            } catch (\Exception $mtEx) {
                Log::error('Midtrans Error: ' . $mtEx->getMessage());
                DB::rollback();
                throw $mtEx;
            }
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Booking Error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan, coba lagi nanti.']);
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        $response = ['status' => 'error', 'message' => 'Invalid signature'];

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $orderId = str_replace('BOOK-', '', $request->order_id); // Hapus prefix "BOOK-"
                $order = Booking::find($orderId);

                if ($order) {
                    $order->update(['status' => 'Paid']);
                    $response = ['status' => 'success', 'message' => 'Payment successful', 'order_id' => $orderId];
                } else {
                    Log::error("Booking dengan ID {$orderId} tidak ditemukan.");
                    $response = ['status' => 'error', 'message' => 'Order not found', 'order_id' => $orderId];
                }
            } else {
                $response = ['status' => 'error', 'message' => 'Transaction status not capture', 'transaction_status' => $request->transaction_status];
            }
        }

        return response()->json($response);
    }

    public function invoice($id)
    {
        // Mencari booking berdasarkan ID
        $booking = Booking::find($id);

        // Jika booking tidak ditemukan, tampilkan pesan error
        if (!$booking) {
            return redirect()->route('booking')->with('error', 'Pemesanan tidak ditemukan.');
        }

        // Mengambil data room untuk menampilkan informasi harga per jam
        $room = Room::find($booking->room_id);

        // Hitung durasi booking dalam jam
        $startTime = Carbon::parse($booking->start_time);
        $endTime = Carbon::parse($booking->end_time);
        $durationInMinutes = $startTime->diffInMinutes($endTime);
        $durationInHours = $durationInMinutes / 60;

        // Hitung total amount
        $totalAmount = $room->price_per_hour * $durationInHours;

        // Menampilkan tampilan invoice
        return view('invoice', compact('booking', 'room', 'totalAmount'));
    }
}
