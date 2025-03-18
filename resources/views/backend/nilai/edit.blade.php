@extends('backend.app')

@section('content')
    <div class="container" style="min-height: 100vh; overflow-y: auto;">
        <div class="page-inner">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border rounded-lg">
                        <div class="card-header text-center bg-dark text-white">
                            <h4 class="card-title mb-0 text-white">Tambah Nilai</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('nilai.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="student_id" class="form-label fw-bold">Nama Siswa</label>
                                    <select id="student_id" name="student_id" class="form-control select2" required>
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="teacher_id" class="form-label fw-bold">Nama Guru</label>
                                    <select id="teacher_id" name="teacher_id" class="form-control select2" required>
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="mapel_id" class="form-label fw-bold">Mata Pelajaran</label>
                                    <select id="mapel_id" name="mapel_id" class="form-control select2" required>
                                        @foreach($mapels as $mapel)
                                            <option value="{{ $mapel->id }}">{{ $mapel->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="nilai" class="form-label fw-bold">Nilai</label>
                                    <input type="number" class="form-control" id="nilai" name="nilai"
                                        value="{{ old('nilai', $nilai->nilai) }}" required>
                                </div>



                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <a href="{{ route('nilai') }}" class="btn btn-secondary">
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
@section('script')
    <!-- Memuat CSS dan JS Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            // Inisialisasi Select2
            $('.select2').select2({
                placeholder: "Pilih opsi",
                allowClear: true,
                width: '100%'  // Pastikan Select2 menyesuaikan dengan lebar container
            });
        });
    </script>
@endsection