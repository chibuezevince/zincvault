@extends('layouts.app')

    @section('content')
        <!-- MAIN CONTENT -->
        <main class="container">
            <div class="row align-items-center justify-content-center vh-100">
                <div class="col-md-7 col-lg-6 d-flex flex-column py-6">
                    
                    <!-- Title -->
                    <h1 class="mb-2">
                        Sign In
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-secondary">
                        Enter your email address and password to access user panel
                    </p>

                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        @error('inactive_user')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="email" autofocus>

                                @error('username')
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
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-5 col-lg-6 px-lg-4 px-xl-6 d-none d-lg-block">

                    <!-- Image -->
                    <div class="text-center">
                        <img src="https://d33wubrfki0l68.cloudfront.net/3ec9ba4912f9c709dc372e44996e05e983962a26/54f2f/assets/images/illustrations/sign-in-illustration.svg" alt="..." class="img-fluid">
                    </div>
                </div>
            </div> <!-- / .row -->
        </main> <!-- / main -->
    @endsection