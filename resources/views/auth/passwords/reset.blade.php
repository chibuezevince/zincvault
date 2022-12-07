@extends('layouts.app')

@section('content')
<!-- MAIN CONTENT -->
<main class="container">
    <div class="row align-items-center justify-content-around vh-100">
        <div class="col-md-5 col-lg-4 d-flex flex-column py-6">
            <!-- Title -->
            <h1 class="mb-2">
                Reset Password
            </h1>

            <!-- Subtitle -->
            <p class="text-secondary">
                Enter your details correctly
            </p>

            <!-- Form -->
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

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
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-4 col-lg-5 px-lg-4 px-xl-5 d-none d-lg-block">

            <!-- Image -->
            <div class="text-center">
                <img src="https://d33wubrfki0l68.cloudfront.net/b5ed4c0d66e218f5ed896a14c723bef8556de9dc/c9b60/assets/images/illustrations/reset-password-illustration.svg" alt="..." class="img-fluid">
            </div>
        </div>
    </div> <!-- / .row -->
</main> <!-- / main -->
@endsection
