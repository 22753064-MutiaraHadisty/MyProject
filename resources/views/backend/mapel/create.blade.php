@extends('backend.app')
@section('content')
    <div class="container">
        <div class="container" style="min-height: 100vh; overflow-y: auto;">
            <div class="page-inner">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow-sm border rounded-lg" style="max-height: 80vh; overflow-y: auto;">
                            <div class="card-header text-center bg-dark text-white">
                                <h4 class="card-title mb-0 text-white">Tambah Mata Pelajaran</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('mapel.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                name="name" value="{{ old('name') }}" required autofocus>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Simpan
                                            </button>
                                            <a href="{{ route('mapel') }}" class="btn btn-secondary">Kembali</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection