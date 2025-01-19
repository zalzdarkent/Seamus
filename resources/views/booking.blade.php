<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Modern</title>
    <!-- Link ke CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Container untuk form -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="row justify-content-center w-100">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">{{ $rooms->name }}</h2>
                    <!-- Alert untuk pesan sukses -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Alert untuk pesan error -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('proses.booking') }}" method="post">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $rooms->id }}">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukkan nama" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Nomor Telepon</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    placeholder="Masukkan nomor telepon" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="date" class="form-label">Tanggal Pemesanan</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="col-md-6">
                                <label for="start_time" class="form-label">Waktu Mulai</label>
                                <select class="form-select" id="start_time" name="start_time" required>
                                    <option value="">Pilih Waktu Mulai</option>
                                    @for ($hour = 8; $hour <= 21; $hour++)
                                        <option value="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00' }}">
                                            {{ str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00' }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="end_time" class="form-label">Waktu Selesai</label>
                                <select class="form-select" id="end_time" name="end_time" required>
                                    <option value="">Pilih Waktu Selesai</option>
                                    @for ($hour = 8; $hour <= 21; $hour++)
                                        <option value="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00' }}">
                                            {{ str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00' }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
