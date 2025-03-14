@extends('backend.app')
@section('content')
    <div class="container">
        <div class="container" style="min-height: 100vh; overflow-y: auto;">
            <div class="page-inner">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow-sm border rounded-lg" >
                            <div class="card-header text-center bg-dark text-white">
                                <h4 class="card-title mb-0 text-white">Tambah User</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.store') }}" method="POST">
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
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                name="email" value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                name="password" required>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm
                                            Password</label>
                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Simpan
                                            </button>
                                            <a href="{{ route('user') }}" class="btn btn-secondary">Kembali</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection