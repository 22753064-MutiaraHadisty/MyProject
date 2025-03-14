@extends('backend.app')

@section('content')
    <div class="container" style="min-height: 100vh; overflow-y: auto;">
        <div class="page-inner">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border rounded-lg">
                        <div class="card-header text-center bg-dark text-white">
                            <h4 class="card-title mb-0 text-white">Edit Teacher</h4>
                        </div>
                        <div class="card-body" > <!-- Container Scrollable -->

                            @if(session('success'))
                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        Swal.fire({
                                            title: "Berhasil!",
                                            text: "{{ session('success') }}",
                                            icon: "success",
                                            confirmButtonText: "OK"
                                        });
                                    });
                                </script>
                            @endif

                            <form action="{{ route('teacher.update', $teacher->id) }}" method="POST"
                                enctype="multipart/form-data" onsubmit="confirmUpdate(event)">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $teacher->name) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', $teacher->email) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telepon</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone', $teacher->phone) }}" required>
                                </div>



                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="address" name="address"
                                        required>{{ old('address', $teacher->address) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="gender" class="form-label">Jenis Kelamin</label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="Laki-Laki" {{ old('gender', $teacher->gender) == 'Laki-Laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('gender', $teacher->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Aktif" {{ old('status', $teacher->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Tidak Aktif" {{ old('status', $teacher->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                </div>

                                <!-- Menampilkan Foto Jika Ada -->
                                <div class="mb-3">
                                    <label class="form-label">Foto Guru</label><br>
                                    @if($teacher->photo)
                                        <img src="{{ asset('backend/images/' . $teacher->photo) }}" class="img-thumbnail"
                                            width="150">
                                    @else
                                        <p class="text-muted">Tidak ada foto</p>
                                    @endif
                                </div>

                                <!-- Input untuk Mengunggah Foto Baru -->
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Ganti Foto (Opsional)</label>
                                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                    <small class="text-muted">Format: jpeg, png, jpg, gif | Maks: 2MB</small>
                                </div>

                                <!-- Tombol Submit dan Batal -->
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-2">Update</button>
                                    <a href="{{ route('teacher') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>

                        </div> <!-- /card-body -->
                    </div> <!-- /card -->
                </div> <!-- /col-md-8 -->
            </div> <!-- /row -->
        </div> <!-- /page-inner -->
    </div> <!-- /container -->

    <!-- SweetAlert untuk Konfirmasi -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmUpdate(event) {
            event.preventDefault();
            let form = event.target;
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data guru akan diperbarui!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Update!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>

@endsection