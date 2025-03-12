@extends('backend.app')

@section('content')
<div class="container" style="min-height: 100vh; overflow-y: auto;">
    <div class="page-inner">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border rounded-lg">
                    <div class="card-header text-center bg-primary text-white">
                        <h4 class="card-title mb-0">Edit Student</h4>
                    </div>
                    <div class="card-body" style="max-height: 80vh; overflow-y: auto;">
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

                        <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data" onsubmit="confirmUpdate(event)">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $student->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $student->email) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Telepon</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $student->phone) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="class" class="form-label">Kelas</label>
                                <input type="text" class="form-control" id="class" name="class" value="{{ old('class', $student->class) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <textarea class="form-control" id="address" name="address" required>{{ old('address', $student->address) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="Laki-Laki" {{ old('gender', $student->gender) == 'Laki-Laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('gender', $student->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="Active" {{ old('status', $student->status) == 'Active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Inactive" {{ old('status', $student->status) == 'Inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Foto Siswa</label><br>
                                @if($student->photo)
                                    <img id="previewImage" src="{{ asset('backend/images/' . $student->photo) }}" class="img-thumbnail" width="150">
                                @else
                                    <p class="text-muted">Tidak ada foto</p>
                                    <img id="previewImage" class="img-thumbnail d-none" width="150">
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="photo" class="form-label">Ganti Foto (Opsional)</label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*" onchange="previewFile()">
                                <small class="text-muted">Format: jpeg, png, jpg, gif | Maks: 2MB</small>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <a href="{{ route('students') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmUpdate(event) {
        event.preventDefault();
        let form = event.target;
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data siswa akan diperbarui!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Update!"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
    
    function previewFile() {
        const preview = document.getElementById('previewImage');
        const file = document.getElementById('photo').files[0];
        const reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            preview.classList.remove('d-none');
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection