<!-- Tombol Detail -->
<button onclick="showDetail({{ $pendaftaran->id }})" class="btn btn-info btn-sm">
    <i class="fas fa-eye"></i> 
</button>

<!-- Tombol Edit -->
<form action="{{ route('pendaftaran.edit', $pendaftaran->id) }}" method="GET" style="display:inline;">
    <button type="submit" class="btn btn-warning btn-sm">
        <i class="fas fa-edit"></i>
    </button>
</form>

<!-- Tombol Hapus -->
<form action="{{ route('pendaftaran.destroy', $pendaftaran->id) }}" method="POST" style="display:inline;"
    onsubmit="return confirmDelete(event);">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="fas fa-trash"></i>
    </button>
</form>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="detailModalLabel">Detail Pendaftaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Nama</th>
                            <td id="detail-nama"></td>
                        </tr>
                        <tr>
                            <th>NISN</th>
                            <td id="detail-nisn"></td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir</th>
                            <td id="detail-tempat-lahir"></td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td id="detail-tanggal-lahir"></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td id="detail-jenis-kelamin"></td>
                        </tr>
                        <tr>
                            <th>Asal Sekolah</th>
                            <td id="detail-asal-sekolah"></td>
                        </tr>
                        <tr>
                            <th>Nomor HP</th>
                            <td id="detail-nomor-hp"></td>
                        </tr>
                        <tr>
                            <th>Nama Ayah</th>
                            <td id="detail-nama-ayah"></td>
                        </tr>
                        <tr>
                            <th>Nama Ibu</th>
                            <td id="detail-nama-ibu"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td id="detail-email"></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td id="detail-status"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center mt-3">
                    <button onclick="updateStatus('diterima')" class="btn btn-success me-2">
                        <i class="fas fa-check"></i> Diterima
                    </button>
                    <button onclick="updateStatus('ditolak')" class="btn btn-danger">
                        <i class="fas fa-times"></i> Ditolak
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentId = null;

    function showDetail(id) {
    $.get(`/pendaftaran/${id}`, function (data) {
        let exportButton = data.status === 'diterima'
            ? `<button onclick="exportPdf(${data.id})" class="btn btn-primary ms-2">Export PDF</button>`
            : '';

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
                    <tr><th>Email</th><td>${data.email}</td></tr>
                    <tr><th>Status</th><td><span class="badge ${data.status === 'diterima' ? 'bg-success' : 'bg-danger'}">${data.status}</span></td></tr>
                </table>
                <div class="mt-3">
                    <button onclick="updateStatus(${data.id}, 'diterima')" class="btn btn-success me-2">Diterima</button>
                    <button onclick="updateStatus(${data.id}, 'ditolak')" class="btn btn-danger">Ditolak</button>
                    ${exportButton}
                </div>
            `,
            icon: "info",
            showCloseButton: true,
            showConfirmButton: false
        });
    });
}

function exportPdf(id) {
    window.location.href = `/pendaftaran/${id}/export-pdf`;
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
    function confirmDelete(event) {
        event.preventDefault();
        let form = event.target;
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data pendaftaran akan dihapus secara permanen!",
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