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
                    <h2 class="text-center mb-4">{{$rooms->name}}</h2>
                    <form action="#" method="post">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $rooms->id }}">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="first-name" class="form-label">Nama Depan:</label>
                                <input type="text" class="form-control" id="first-name" placeholder="Masukkan nama depan" required>
                            </div>
                            <div class="col-md-6">
                                <label for="last-name" class="form-label">Nama Belakang:</label>
                                <input type="text" class="form-control" id="last-name" placeholder="Masukkan nama belakang" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Masukkan email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Nomor Telepon:</label>
                                <input type="tel" class="form-control" id="phone" placeholder="Masukkan nomor telepon" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat:</label>
                            <textarea class="form-control" id="address" rows="3" placeholder="Masukkan alamat" required></textarea>
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
