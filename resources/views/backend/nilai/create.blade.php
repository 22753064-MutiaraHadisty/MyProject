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

                                <div class="form-group row">
                                    <label for="student_id" class="col-md-4 col-form-label text-md-right">Nama Siswa</label>
                                    <div class="col-md-6">
                                        <select id="student_id" class="form-control" name="student_id" required>
                                            <option value="">Pilih Siswa</option>
                                            @foreach($students as $student)
                                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="teacher_id" class="col-md-4 col-form-label text-md-right">Nama Guru</label>
                                    <div class="col-md-6">
                                        <select id="teacher_id" class="form-control" name="teacher_id" required>
                                            <option value="">Pilih Guru</option>
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mapel_id" class="col-md-4 col-form-label text-md-right">Mata
                                        Pelajaran</label>
                                    <div class="col-md-6">
                                        <select id="mapel_id" class="form-control" name="mapel_id" required>
                                            <option value="">Pilih Mata Pelajaran</option>
                                            @foreach($mapels as $mapel)
                                                <option value="{{ $mapel->id }}">{{ $mapel->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nilai" class="col-md-4 col-form-label text-md-right">Nilai</label>
                                    <div class="col-md-6">
                                        <input id="nilai" type="number" class="form-control" name="nilai" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                        <a href="{{ route('nilai') }}" class="btn btn-secondary">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection