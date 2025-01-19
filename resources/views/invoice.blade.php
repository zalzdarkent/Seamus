<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pemesanan</title>
    <!-- Link ke CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Container untuk invoice -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="row justify-content-center w-100">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">Invoice Pemesanan Ruangan</h2>

                    <!-- Alert untuk pesan sukses -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Menampilkan Detail Pemesanan -->
                    <div class="mb-3">
                        <p><strong>Nama Pemesan:</strong> {{ $booking->name }}</p>
                        <p><strong>Nomor Telepon:</strong> {{ $booking->phone }}</p>
                        <p><strong>Ruangan:</strong> {{ $room->name }}</p>
                        <p><strong>Tanggal Pemesanan:</strong> {{ $booking->date }}</p>
                        <p><strong>Waktu Mulai:</strong> {{ $booking->start_time }}</p>
                        <p><strong>Waktu Selesai:</strong> {{ $booking->end_time }}</p>
                    </div>

                    <!-- Menghitung durasi dalam jam -->
                    @php
                        $startTime = \Carbon\Carbon::parse($booking->start_time);
                        $endTime = \Carbon\Carbon::parse($booking->end_time);
                        $durationInMinutes = $startTime->diffInMinutes($endTime);
                        $durationInHours = $durationInMinutes / 60;
                        $totalAmount = $room->price_per_hour * $durationInHours;
                    @endphp

                    <div class="mb-3">
                        <p><strong>Total Durasi:</strong> {{ number_format($durationInHours, 2) }} jam</p>
                        <p><strong>Harga Per Jam:</strong> Rp {{ number_format($room->price_per_hour, 0, ',', '.') }}</p>
                        <p><strong>Total Biaya:</strong> Rp {{ number_format($totalAmount, 0, ',', '.') }}</p>
                    </div>

                    <!-- Status Pembayaran -->
                    <div class="mb-3">
                        <p><strong>Status Pembayaran:</strong>
                            @if($booking->status == 'Paid')
                                <span class="badge bg-success">Lunas</span>
                            @else
                                <span class="badge bg-danger">Belum Lunas</span>
                            @endif
                        </p>
                    </div>

                    <!-- Tombol Kembali ke Daftar Pemesanan -->
                    <a href="{{ route('index') }}" class="btn btn-primary w-100">Kembali ke Halaman Utama</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
