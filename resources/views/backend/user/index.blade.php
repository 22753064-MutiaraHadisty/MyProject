@extends('backend.app')

@section('content')

    <div class="container">
        <h1 class="fw-bold mb-3 text-center">Halaman User</h1>
        <a href="{{ route('user.create') }}" class="btn btn-dark btn-sm mb-3 ms-4">
            <i class="fas fa-plus"></i> Tambah User
        </a>

        <form method="GET" action="{{ route('user') }}" class="mb-3 ms-4">
            <div class="input-group" style="max-width: 500px;">
                <input type="search" name="search" class="form-control" placeholder="Search Name Or Email"
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-dark">Cari</button>
            </div>
        </form>

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

        <div class="card shadow-sm ms-4 me-4">
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered table-sm text-center small">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 35%;">Nama</th>
                                <th style="width: 40%;">Email</th>
                                <th style="width: 20%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $index => $user)
                                <tr class="table-light">
                                    <td>{{ $users->firstItem() + $index }}</td>
                                    <td class="text-start">{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline"
                                                onsubmit="return confirmDelete(event)">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Tidak ada data user</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-column align-items-center mt-3">
                    <div>
                        {{ $users->appends(['search' => request('search')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            let form = event.target;
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "User akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>

    <style>
        .table-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            margin: auto;
            /* Pusatkan tabel */
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

        .btn-warning:hover {
            background: #ffc107;
            transform: translateY(-2px);
        }

        .btn-danger:hover {
            background: #dc3545;
            transform: translateY(-2px);
        }

        .table-responsive {
            max-height: 450px;
            overflow-y: auto;
            border-radius: 10px;
            scrollbar-width: thin;
            scrollbar-color: rgb(37, 40, 44) #f1f1f1;
        }

        .table-responsive::-webkit-scrollbar {
            width: 8px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #007bff;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #0056b3;
        }
    </style>

@endsection