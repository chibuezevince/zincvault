@extends('layouts.app')

@section('content')
 <!-- MAIN CONTENT -->
 <main class="container">
    <div class="row align-items-center justify-content-center vh-100">
        <div class="col-md-7 col-lg-6 d-flex flex-column py-6">
            <div class="my-auto">
                <!-- Title -->
                <h1 class="mb-2">
                    Free Sign Up
                </h1>

                <!-- Subtitle -->
                <p class="text-secondary">
                    Don't have an account? Create your account, it takes less than a minute
                </p>

                <!-- Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                        <div class="col-md-6">
                            <input id="phone_number" type="phone_number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone">

                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="account_type" class="col-md-4 col-form-label text-md-end">{{ __('Account Type') }}</label>

                        <div class="col-md-6">
                            <select class="form-select @error('account_type') is-invalid @enderror" id="validationCustom04" required name="account_type">
                              <option selected disabled value="">Choose...</option>
                              <option value="Current Account">Current Account</option>
                              <option value="Savings Account">Savings Account</option>
                              <option value="Checking Account">Checking Account</option>
                            </select>
                            @error('account_type')
                            <div class="invalid-feedback">
                              Please select an option.
                            </div>
                            @enderror
                        </div>
                    </div>    

                    <div class="row mb-3">
                        <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                        <div class="col-md-6">
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" required name="gender">
                              <option selected disabled value="">Choose...</option>
                              <option value="Female">Female</option>
                              <option value="Male">Male</option>
                            </select>
                            @error('gender')
                            <div class="invalid-feedback">
                              Please select an option.
                            </div>
                            @enderror
                        </div>
                    </div>    

                    <div class="row mb-3">
                        <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                        <div class="col-md-6">
                            <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

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
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-5 col-lg-6 px-lg-4 px-xl-6 d-none d-lg-block">

            <!-- Image -->
            <div class="text-center">
                <img src="https://d33wubrfki0l68.cloudfront.net/d7b3128e115346d419e411ffe3ac9a97c6c1bbd5/70041/assets/images/illustrations/sign-up-illustration.svg" alt="..." class="img-fluid">
            </div>
        </div>
    </div> <!-- / .row -->
</main> <!-- / main -->
@endsection
