@extends('backend.app')

@section('content')


    <div class="container">
        <h1 class="fw-bold mb-3 text-center">Halaman Mata Pelajaran</h1>

        <a href="{{ route('mapel.create') }}" class="btn btn-dark btn-sm mb-3 ms-4">
            <i class="fas fa-plus"></i> Tambah Mata Pelajaran
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
                    <table class="table table-hover table-striped table-bordered table-sm" id="mapel" width="100%">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 65%;">Nama Mata Pelajaran</th>
                                <th style="width: 30%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @section('script')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#mapel').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('mapel') }}",
                    dom: '<"top d-flex justify-content-between mb-3"lf>rt<"bottom"ip><"clear">',
                    columns: [
                        {
                            data: null,
                            name: 'id',
                            render: function (data, type, row, meta) {
                                return meta.row + 1; // Menjadikan angka urut
                            }
                        },
                        { data: 'name', name: 'name' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });
            });

            function confirmDelete(event) {
                event.preventDefault();
                let form = event.target;
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Mata pelajaran akan dihapus secara permanen!",
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
@endsection