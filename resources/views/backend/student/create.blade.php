@extends('backend.app')

@section('content')
<div class="container" style="min-height: 100vh; overflow-y: auto;">
    <div class="page-inner">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border rounded-lg" style="max-height: 80vh; overflow-y: auto;">
                    <div class="card-header text-center bg-primary text-white">
                        <h4 class="card-title mb-0">Tambah Siswa</h4>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Telepon</label>
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="class">Kelas</label>
                                <input id="class" type="text" class="form-control @error('class') is-invalid @enderror" name="class" value="{{ old('class') }}" required>
                                @error('class')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" required>{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki" {{ old('gender') == 'Laki-Laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="photo">Upload Foto</label>
                                <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" accept="image/*" onchange="previewImage(event)">
                                <small class="text-muted">Format: jpeg, png, jpg, gif | Maks: 2MB</small>
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <br>
                                <img id="photo-preview" src="#" class="img-thumbnail d-none" width="100">
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                                <a href="{{ route('students') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(session()->has('success'))
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => {
                window.location.href = "{{ route('students') }}";
            });
        @endif
    });

    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('photo-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
