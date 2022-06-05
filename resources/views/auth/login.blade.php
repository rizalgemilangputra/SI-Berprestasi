@extends('layouts.login')

@section('content')
    <div class="row">
        <div class="col-lg-5 col-12">
            <div id="auth-left" style="height: 100vh !important;">
                <h1 class="auth-title">Log in.</h1>
                <p class="auth-subtitle mb-5">Log in dengan data yang sudah di daftarkan.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-xl @error('email') is-invalid @enderror" aria-describedby="validation" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>

                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-xl" placeholder="Password" name="password" required>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                    <p class="text-gray-600">Anda lupa akun? hubungi bagian kesiswaan.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right" style="height: 100vh !important; background-image: url('{{asset('assets/images/bg/kampus-unikom.jpg')}}');height: 100%;background-position: center;background-repeat: no-repeat;background-size: cover;">
            </div>
        </div>
    </div>
@endsection
