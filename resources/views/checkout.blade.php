<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="d-flex justify-content-center"> <!-- Membuat tampilan di tengah -->
            <div class="row w-75"> <!-- Mengatur lebar grid agar tidak terlalu besar -->

                <!-- Bagian Gambar Ruangan (Kiri) -->
                <div class="col-md-6">
                    <div class="card shadow-lg p-4">
                        <h2 class="text-center">Ruangan {{ $room->name }}</h2>
                        <img src="{{ asset('storage/' . $room->photo) }}" class="img-fluid rounded">
                    </div>
                </div>

                <!-- Bagian Detail Booking (Kanan) -->
                <div class="col-md-6">
                    <div class="card shadow-lg p-4">
                        <h2 class="text-center">Detail Booking</h2>
                        <table class="table">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $booking->name }}</td>
                            </tr>
                            <tr>
                                <th>Telepon</th>
                                <td>{{ $booking->phone }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>{{ $booking->date }}</td>
                            </tr>
                            <tr>
                                <th>Waktu Mulai</th>
                                <td>{{ $booking->start_time }}</td>
                            </tr>
                            <tr>
                                <th>Waktu Selesai</th>
                                <td>{{ $booking->end_time }}</td>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                <td>Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </table>

                        <!-- Tombol Bayar Sekarang -->
                        @if (isset($snapToken))
                            <button id="pay-button" class="btn btn-success w-100">Bayar Sekarang</button>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Midtrans JS -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script>
        document.getElementById('pay-button').onclick = function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    // Arahkan ke halaman invoice menggunakan ID booking yang benar
                    window.location.href = '/booking/invoice/' + result.order_id.replace('BOOK-', '');  // Hapus 'BOOK-' jika itu bukan ID numerik
                },
                onPending: function(result) {
                    alert("Pembayaran sedang diproses. Harap tunggu.");
                },
                onError: function(result) {
                    alert("Terjadi kesalahan pada pembayaran.");
                }
            });
        };
    </script>
    

</body>

</html>
