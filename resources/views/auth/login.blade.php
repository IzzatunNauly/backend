@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
    <div class="col-md-6" style="background-color: #2A3045; min-height: 100vh; display: flex; align-items: center; justify-content: center;">
        <!-- Masukkan gambar di sini -->
        <img src="{{ asset('images/gambar.png') }}" alt="Deskripsi gambar" width="300" height="400">
    </div>

        <div class="col-md-6" style="min-height: 100vh;"> <!-- Bagian Kanan -->
            <div class="row">
                <div class="col-md-12 text-center" style="margin-top: 50px;"> <!-- Tengahkan teks -->
                    <div style="font-family: 'Times New Roman', sans-serif; font-size: 30px; font-weight: bold;"> <!-- Jenis tulisan Times New Roman -->
                        <div>{{ __('WELCOME!!!') }}</div>
                    </div>
                </div>
                <div class="col-md-12 text-center">{{ __('Sign In To Continue') }}</div>
            </div>
            <style>
            .container {
                width: 500px; /* Ganti nilai ini dengan lebar yang diinginkan */
                height: 100px; /* Ganti nilai ini dengan panjang yang diinginkan */
            }
            </style>
</br>
            <div class="container">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                </br>
                    <div class="mb-3"> <!-- Menambahkan margin-bottom di sini -->
                        <label for="username" class="form-label">{{ __('Username') }}</label>
                        <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus style="background-color: #F0F8FF;">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </br>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="background-color: #F0F8FF;">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </br>
                <div class="col-md-12 text-center">
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <button type="submit" class="btn btn-primary" style="background-color: #6892E3; border-color: #000000; padding: 5px 50px; border-width: 2px; font-size: 15px;">
                            {{ __('LOGIN') }}
                        </button>
                        <span style="margin-left: 10px;">Dont have an account? <a href="{{ route('register') }}" style="text-decoration: none; color: #6892E3;">Register HERE</a></span>
                    </div>
                    <div style="margin-top: 5px;">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}" style="text-decoration: none;">
                                    <span style="color: #000000; font-weight: bold;">{{ __('Forgot Your Password?') }}</span>
                                </a>
                            @endif
                        </div>
                </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
