@extends('backend.app')

@section('content')

    <div class="container">
        <!-- Header Halaman -->
        <h1 class="fw-bold mb-3 text-center">Halaman Teachers</h1>
        <a href="{{ route('teacher.create') }}" class="btn btn-dark btn-sm mb-4 ms-4">
            <i class="fas fa-plus"></i> Tambah Teacher
        </a>

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('teacher') }}" class="mb-3  ms-4">
            <div class="input-group" style="max-width: 500px;">
                <input type="search" name="search" class="form-control" placeholder="Search "
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-dark">Cari</button>
            </div>
        </form>

        <!-- Notifikasi Berhasil -->
        @if(session('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    Swal.fire({
                        title: "Berhasil!",
                        text: @json(session('success')),
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                });
            </script>
        @endif

        <!-- Card Tabel -->
    <div class="card shadow-sm ms-4 me-4">
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-sm text-center small">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Status</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($teachers as $index => $teacher)
                            <tr class="table-light">
                                <td>{{ $teachers->firstItem() + $index }}</td>
                                <td class="text-start">{{ $teacher->name }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->phone }}</td>
                                <td class="text-start">{{ $teacher->address }}</td>
                                <td>
                                    <span class="badge bg-{{ $teacher->gender == 'Laki-Laki' ? 'info' : 'warning' }}">
                                        <i class="fas fa-{{ $teacher->gender == 'Laki-Laki' ? 'male' : 'female' }}"></i>
                                        {{ $teacher->gender }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $teacher->status == 'Aktif' ? 'success' : 'danger' }}">
                                        <i
                                            class="fas fa-{{ $teacher->status == 'Aktif' ? 'check-circle' : 'times-circle' }}"></i>
                                        {{ $teacher->status }}
                                    </span>
                                </td>
                                <td>
                                    @if($teacher->photo)
                                        <img src="{{ asset('backend/images/' . $teacher->photo) }}" alt="Foto Guru"
                                            class="img-thumbnail" width="50">
                                    @else
                                        <span class="text-muted">Tidak Ada</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm delete-btn"
                                        data-url="{{ route('teacher.destroy', $teacher->id) }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">Tidak ada data guru</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Keterangan Jumlah Data & Paginasi -->
                <div class="d-flex justify-content-center align-items-center mt-3 flex-column">
                    <div>
                        {{ $teachers->appends(['search' => request('search')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert untuk konfirmasi hapus -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function () {
                    confirmDelete(this.getAttribute('data-url'));
                });
            });
        });

        function confirmDelete(url) {
            Swal.fire({
                title: "Yakin ingin menghapus?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    let csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = @json(csrf_token());

                    let methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';

                    form.appendChild(csrfInput);
                    form.appendChild(methodInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
    <style>
        .table {
            border-collapse: collapse;
            width: 100%;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            background: linear-gradient(135deg, rgb(23, 27, 32), rgb(90, 88, 94));
            color: white;
            text-transform: uppercase;
            font-weight: bold;
            padding: 12px;
            border: none;
        }

        .table tbody td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            transition: all 0.3s ease-in-out;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
            transform: scale(1.02);
        }

        .btn-sm {
            border-radius: 5px;
            transition: all 0.3s ease;
        }
    </style>

@endsection