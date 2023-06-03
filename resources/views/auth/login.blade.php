@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row d-flex justify-content-between align-items-center">
        <div class="col-md-6 mt-5">
            <img class="img-fluid" style="width: 25em" src="{{ asset('logosma5.jpg') }}">
        </div>
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-header text-center">
                    <h3>{{ __('Login') }}</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn" style="background-color: #28a745; width: 140px; color: white;">
                                    {{ __('Login') }}
                                </button>

                               {{--  @if (Route::has('password.request'))
                                    <a style="text-decoration:none;" class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Lupa Password ?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>

                        {{-- <div class="row mb-0 mt-4">
                            <div class="col-md-8 offset-md-4">
                                @if (Route::has('register'))
                                    <p>Belum punya akun ? <a style="text-decoration: none" href="{{ route('register') }}">{{ __('Registrasi di sini') }}</a></p>
                                @endif
                            </div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
