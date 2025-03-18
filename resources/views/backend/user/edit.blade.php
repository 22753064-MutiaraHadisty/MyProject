@extends('backend.app')

@section('content')
    <div class="container" style="min-height: 100vh; overflow-y: auto;">
        <div class="page-inner">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border rounded-lg">
                        <div class="card-header text-center bg-dark text-white">
                            <h4 class="card-title mb-0 text-white">Edit User</h4>
                        </div>
                        <div class="card-body" >
                            <!-- Notifikasi SweetAlert -->
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

                            <!-- Form Edit User -->
                            <form action="{{ route('user.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $user->email }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold">Password (Biarkan kosong jika tidak
                                        ingin mengubah)</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update
                                    </button>
                                    <a href="{{ route('user') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection