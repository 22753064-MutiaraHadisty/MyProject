@extends('backend.app')

@section('content')
    <div class="container">
        <h1 class="fw-bold mb-3 text-center">Halaman Pendaftaran</h1>

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
                    <table class="table table-hover table-striped table-bordered table-sm" id="pendaftaran" width="100%">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Nama</th>
                                <th width="15%">NISN</th>
                                <th width="15%">Asal Sekolah</th>
                                <th width="15%">Email</th>
                                <th width="15%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#pendaftaran').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('pendaftaran') }}",
                dom: '<"top d-flex justify-content-between mb-3"lf>rt<"bottom"ip><"clear">',
                columns: [
                    { data: null, render: function (data, type, row, meta) { return meta.row + 1; } },
                    { data: 'nama' },
                    { data: 'nisn' },
                    { data: 'asal_sekolah' },
                    { data: 'email' },
                    {
                        data: 'status', render: function (data) {
                            return `<span class="badge ${data === 'diterima' ? 'bg-success' : data === 'ditolak' ? 'bg-danger' : 'bg-warning'}">${data}</span>`;
                        }
                    },

                    { data: 'action', orderable: false, searchable: false }
                ]
            });
        });

        function showDetail(id) {
            $.get(`/pendaftaran/${id}`, function (data) {
                Swal.fire({
                    title: "Detail Pendaftaran",
                    html: `
                                        <table class="table table-bordered">
                                            <tr><th>Nama</th><td>${data.nama}</td></tr>
                                            <tr><th>NISN</th><td>${data.nisn}</td></tr>
                                            <tr><th>Tempat Lahir</th><td>${data.tempat_lahir}</td></tr>
                                            <tr><th>Tanggal Lahir</th><td>${data.tanggal_lahir}</td></tr>
                                            <tr><th>Jenis Kelamin</th><td>${data.jenis_kelamin}</td></tr>
                                            <tr><th>Asal Sekolah</th><td>${data.asal_sekolah}</td></tr>
                                            <tr><th>Nomor HP</th><td>${data.nomor_hp}</td></tr>
                                            <tr><th>Nama Ayah</th><td>${data.nama_ayah}</td></tr>
                                            <tr><th>Nama Ibu</th><td>${data.nama_ibu}</td></tr>
                                            <tr><th>Email</th><td>${data.email}</td></tr>
                                            <tr><th>Status</th><td><span class="badge ${data.status === 'diterima' ? 'bg-success' : data.status === 'ditolak' ? 'bg-danger' : 'bg-warning'}">${data.status}</span></td></tr>
                                        </table>
                                        <div class="mt-3">
                                            <button onclick="updateStatus(${data.id}, 'diterima')" class="btn btn-success me-2">Diterima</button>
                                            <button onclick="updateStatus(${data.id}, 'ditolak')" class="btn btn-danger">Ditolak</button>
                                        </div>
                                    `,
                    icon: "info",
                    showCloseButton: true,
                    showConfirmButton: false
                });
            });
        }

        function updateStatus(id, status) {
            $.ajax({
                url: `/pendaftaran/${id}/update-status`,
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    status: status
                },
                success: function () {
                    Swal.fire("Sukses!", "Status berhasil diperbarui", "success").then(() => {
                        $('#pendaftaran').DataTable().ajax.reload();
                    });
                }
            });
        }
    </script>
@endsection