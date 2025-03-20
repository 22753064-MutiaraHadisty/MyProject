<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pendaftaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 900px;
            margin-top: 50px;
        }

        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }

        .btn-custom {
            width: 100%;
            font-weight: bold;
            border-radius: 8px;
        }

        .form-control {
            border-radius: 10px;
        }

        .form-label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="fw-bold text-center mb-3">Edit Pendaftaran</h1>

        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="editPendaftaranForm" action="{{ route('pendaftaran.update', $pendaftaran->id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control mb-2" id="nama" name="nama" required
                        value="{{ old('nama', $pendaftaran->nama) }}">

                    <label for="nisn" class="form-label">NISN</label>
                    <input type="text" class="form-control mb-2" id="nisn" name="nisn" required
                        value="{{ old('nisn', $pendaftaran->nisn) }}">

                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control mb-2" id="tempat_lahir" name="tempat_lahir" required
                        value="{{ old('tempat_lahir', $pendaftaran->tempat_lahir) }}">

                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control mb-2" id="tanggal_lahir" name="tanggal_lahir" required
                        value="{{ old('tanggal_lahir', $pendaftaran->tanggal_lahir) }}">

                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-control mb-2" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>
                            Laki-Laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan</option>
                    </select>

                    <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                    <input type="text" class="form-control mb-2" id="asal_sekolah" name="asal_sekolah" required
                        value="{{ old('asal_sekolah', $pendaftaran->asal_sekolah) }}">

                    <label for="nomor_hp" class="form-label">Nomor HP</label>
                    <input type="text" class="form-control mb-2" id="nomor_hp" name="nomor_hp" required
                        value="{{ old('nomor_hp', $pendaftaran->nomor_hp) }}">

                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control mb-2" id="email" name="email" required
                        value="{{ old('email', $pendaftaran->email) }}">

                    <label for="nama_ayah" class="form-label">Nama Ayah</label>
                    <input type="text" class="form-control mb-2" id="nama_ayah" name="nama_ayah" required
                        value="{{ old('nama_ayah', $pendaftaran->nama_ayah) }}">

                    <label for="nama_ibu" class="form-label">Nama Ibu</label>
                    <input type="text" class="form-control mb-2" id="nama_ibu" name="nama_ibu" required
                        value="{{ old('nama_ibu', $pendaftaran->nama_ibu) }}">

                    <button type="submit" class="btn btn-primary btn-custom mt-3">Update</button>
                    <a href="{{ route('pendaftaran') }}" class="btn btn-dark btn-custom mt-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>