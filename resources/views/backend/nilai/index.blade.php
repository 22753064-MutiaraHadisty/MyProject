@extends('backend.app')

@section('content')
    <div class="container">
        <h1 class="fw-bold mb-3 text-center">Halaman Nilai</h1>
        <a href="{{ route('nilai.create') }}" class="btn btn-dark btn-sm mb-3 ms-4">
            <i class="fas fa-plus"></i> Tambah Nilai
        </a>

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
                    <table id="nilai"
                        class="table table-hover table-striped table-bordered table-sm text-center small">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 30%;">Nama Siswa</th>
                                <th style="width: 25%;">Nama Guru</th>
                                <th style="width: 20%;">Mata Pelajaran</th>
                                <th style="width: 10%;">Nilai</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
    
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#nilai').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('nilai') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'student_name', name: 'student.name' },
                    { data: 'teacher_name', name: 'teacher.name' },
                    { data: 'mapel_name', name: 'mapel.name' },
                    { data: 'nilai', name: 'nilai' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });

        function confirmDelete(event) {
            event.preventDefault();
            let form = event.target;
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Nilai akan dihapus secara permanen!",
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