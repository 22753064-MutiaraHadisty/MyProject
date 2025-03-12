@extends('backend.app')

@section('content')

<div class="container">
    <h3 class="fw-bold mb-3">Halaman Students</h3>
    <a href="{{ route('students.create') }}" class="btn btn-info btn-sm mb-3">
        <i class="fas fa-plus"></i> Tambah Student
    </a>

    <!-- Form Pencarian -->
    <form method="GET" action="{{ route('students') }}" class="mb-3">
    <div class="input-group" style="max-width: 500px;">
        <input type="text" name="search" class="form-control" placeholder="Search Name Or Email" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Cari</button>
    </div>
</form>


    @if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        });
    </script>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-2">
            <div class="table-responsive" style="overflow-y: auto; max-height: 400px;">
                <table class="table table-hover table-striped table-bordered table-sm text-center small">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Kelas</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Status</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $index => $student)
                        <tr class="table-light">
                            <td>{{ $students->firstItem() + $index }}</td>
                            <td class="text-start">{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td><span class="badge bg-primary">{{ $student->class }}</span></td>
                            <td class="text-start">{{ $student->address }}</td>
                            <td>
                                @if($student->gender == 'Laki-Laki')
                                    <span class="badge bg-info"><i class="fas fa-male"></i> L</span>
                                @else
                                    <span class="badge bg-warning"><i class="fas fa-female"></i> P</span>
                                @endif
                            </td>
                            <td>
                                @if($student->status == 'Active')
                                    <span class="badge bg-success"><i class="fas fa-check-circle"></i> Aktif</span>
                                @else
                                    <span class="badge bg-danger"><i class="fas fa-times-circle"></i> Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                @if($student->photo)
                                    <img src="{{ asset('backend/images/' . $student->photo) }}" alt="Foto Siswa" class="img-thumbnail" width="50">
                                @else
                                    <span class="text-muted">Tidak Ada</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event, this)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">Tidak ada data siswa</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginasinya dengan keterangan jumlah data -->
            <div class="d-flex justify-content-center align-items-center mt-3 flex-column">
            <!-- <div class="text-muted small mb-2">
                Showing {{ $students->firstItem() }} - {{ $students->lastItem() }} of {{ $students->total() }} results
            </div> -->
            <div>
                {{ $students->appends(['search' => request('search')])->links() }}
            </div>
        </div>
        </div>
    </div>
</div>

<!-- SweetAlert untuk konfirmasi hapus -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(event, form) {
        event.preventDefault();
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
                form.submit();
            }
        });
    }
</script>

@endsection