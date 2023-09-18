@extends('layouts.mahasiswa.master')
@section('container')
<main class="container-fluid h-100">
    <div class="overflow-auto row h-100">
        <div class="px-0 mb-auto text-center col-12">
            <header class="header">
                <div class="row">
                    <div class="col-auto"></div>
                    <div class="col">
                        <div class="logo-small">
                            <img src="{{ asset('mahasiswa/img/logo.png') }}" alt="">
                            <h5>FiMobile</h5>
                        </div>
                    </div>
                    <div class="col-auto"></div>
                </div>
            </header>
        </div>
        <div class="py-4 mx-auto text-center col-10 col-md-6 col-lg-5 col-xl-3 align-self-center">
            <h1 class="mb-4 text-color-theme">Sign in</h1>
                <form class="was-validated needs-validation" novalidate action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3 form-group form-floating is-valid">
                        <input type="text" class="form-control" id="loginname" name="loginname" placeholder="Email/NIM"
                            value="{{ old('loginname') }}" required autofocus autocomplete="username">
                        <label class="form-control-label" for="loginname">Email/NIM</label>
                    </div>
                    <div class="mb-3 form-group form-floating is-invalid">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required autocomplete="current-password">
                        <label class="form-control-label" for="password">Password</label>
                        <button type="button" class="text-danger tooltip-btn" data-bs-toggle="tooltip" data-bs-placement="left" title="Enter valid Password" id="passworderror"><i class="bi bi-info-circle"></i></button>
                    </div>
                    <p class="mb-3 text-center"><a href="{{ route('password.request') }}" class="">Forgot your password?</a></p>
                    <button type="submit" class="mb-4 shadow btn btn-lg btn-default w-100">Sign in</button>
                </form>
        </div>
    </div>
</main>
@endsection
