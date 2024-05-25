@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6" style="background-color: #2A3045; min-height: 100vh; display: flex; align-items: center; justify-content: center;">
            <!-- Masukkan gambar di sini -->
            <img src="{{ asset('images/gambar.png') }}" alt="Deskripsi gambar" width="300" height="400">
        </div>

        <div class="col-md-6" style="min-height: 100vh;"> <!-- Bagian Kanan -->
            <div class="row">
                <div class="col-md-12 text-center" style="margin-top: 30px;"> <!-- Tengahkan teks -->
                    <div style="font-family: 'Times New Roman', sans-serif; font-size: 30px; font-weight: bold;"> <!-- Jenis tulisan Times New Roman -->
                        <div>{{ __('HI!!!') }}</div>
                    </div>
                    <div class="col-md-12 text-center">{{ __('Create a new acount') }}</div>
                </div>
            </div>
            <style>
                .container {
                    width: 500px; /* Ganti nilai ini dengan lebar yang diinginkan */
                    height: auto; /* Ganti nilai ini dengan panjang yang diinginkan */
                }
            </style>
            <div class="container">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3"> <!-- Menambahkan margin-bottom di sini -->
                        <label for="name" class="form-label">{{ __('Full Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus style="background-color: #F0F8FF;">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">{{ __('Username') }}</label>
                        <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" style="background-color: #F0F8FF;">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ __('Phone Number') }}</label>
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" style="background-color: #F0F8FF;">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" style="background-color: #F0F8FF;">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="background-color: #F0F8FF;">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="background-color: #F0F8FF;">
                    </div>
                    <div class="col-md-12 text-center">
                        <div style="display: flex; align-items: center; justify-content: center;">
                            <button type="submit" class="btn btn-primary" style="background-color: #6892E3; border-color: #000000; padding: 5px 50px; border-width: 2px; font-size: 15px;">
                                {{ __('Register') }}
                            </button>
                            <span style="margin-left: 10px;">Already have an account? <a href="{{ route('login') }}" style="text-decoration: none; color: #6892E3;">Login HERE</a></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection