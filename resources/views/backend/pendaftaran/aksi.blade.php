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
        currentId = id;
        $.get(`/pendaftaran/${id}`, function (data) {
            $('#detail-nama').text(data.nama);
            $('#detail-nisn').text(data.nisn);
            $('#detail-tempat-lahir').text(data.tempat_lahir);
            $('#detail-tanggal-lahir').text(data.tanggal_lahir);
            $('#detail-jenis-kelamin').text(data.jenis_kelamin);
            $('#detail-asal-sekolah').text(data.asal_sekolah);
            $('#detail-nomor-hp').text(data.nomor_hp);
            $('#detail-nama-ayah').text(data.nama_ayah);
            $('#detail-nama-ibu').text(data.nama_ibu);
            $('#detail-email').text(data.email);

            let badgeClass = data.status === 'diterima' ? 'bg-success' : (data.status === 'ditolak' ? 'bg-danger' : 'bg-warning');
            $('#detail-status').html(`<span class="badge ${badgeClass}">${data.status}</span>`);

            $('#detailModal').modal('show');
        });
    }

    function updateStatus(status) {
        if (!currentId) return;
        $.ajax({
            url: `/pendaftaran/${currentId}/update-status`,
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                status: status
            },
            success: function () {
                $('#detailModal').modal('hide');
                $('#pendaftaran').DataTable().ajax.reload();
                Swal.fire("Berhasil!", "Status berhasil diperbarui.", "success");
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