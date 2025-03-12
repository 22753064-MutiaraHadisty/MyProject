@extends('backend.app')

@section('content')

<div class="container">
    <!-- Header Halaman -->
    <h3 class="fw-bold mb-3">Halaman User</h3>
    <a href="{{ route('user.create') }}" class="btn btn-info btn-sm mb-3">
        <i class="fas fa-plus"></i> Tambah User
    </a>

    <!-- Form Pencarian -->
    <form method="GET" action="{{ route('user') }}" class="mb-3">
    <div class="input-group" style="max-width: 500px;">
        <input type="text" name="search" class="form-control" placeholder="Search Name Or Email" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Cari</button>
    </div>
</form>

    <!-- Notifikasi Berhasil -->
    @if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
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
    <div class="card shadow-sm">
        <div class="card-body p-2">
            <div class="table-responsive" style="overflow-y: auto; max-height: 400px;">
                <table class="table table-hover table-striped table-bordered table-sm text-center small">
                    <thead class="table-primary">
                        <tr>
                            <th style="width: 5%;">No</th> <!-- Selalu tampil -->
                            <th style="width: 35%;">Nama</th>
                            <th style="width: 40%;">Email</th>
                            <th style="width: 20%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                        <tr class="table-light">
                            <td>{{ $users->firstItem() + $index }}</td> <!-- Pastikan nomor tetap muncul -->
                            <td class="text-start">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event)">
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
<!-- Keterangan Jumlah Data & Paginasi -->
<div class="d-flex flex-column align-items-center mt-3">
    </div>
    <div>
        {{ $users->appends(['search' => request('search')])->links() }}
    </div>
</div>
    </div>
</div>
</div>

<!-- SweetAlert untuk konfirmasi hapus -->
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

@endsection
