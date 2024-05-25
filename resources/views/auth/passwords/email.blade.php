@extends('layouts.app')

@section('content')
<div class="row" style="background-color:white; width:100%; height:100%; margin-top:0px; overflow:hidden;" >
    <div class="col-md-6" style="background-color: white;">
        <div class="image" style="background-color: #2A3045; width:100vw; top:120px; padding-top:30px; margin-bottom:80px; height: 500px;">
            <img src="{{ asset('images/gambar1.png') }}" alt="Deskripsi gambar" width="450" height="450">
        </div>
    </div>
    <div class="col-md-6" style="background-color: white; border-radius: 20px; border: 2px solid #cccccc; margin-top:30px; height:520px; width: 550px;">
        <div class="row">
            <div class="col-md-12 text-center" style="margin-top: 30px;"> 
                <div style="font-family: 'Times New Roman', sans-serif; font-size: 30px; font-weight: bold;">
                    <div>{{ __('Forgot Password') }}</div>
                </div>
            </div>
            <div class="col-md-12 text-center" style="margin-top: 10px;padding: 10px 110px;">{{ __('Dont worry, we will send you a link to change your password. Please enter your email.') }}</div>
        </div>
            <div class="container" style="margin-top: 30px; padding: 10px 100px;">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="background-color: #F0F8FF;">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-12 text-center" style="margin-top: 50px;">
                        <div style="display: flex; align-items: center; justify-content: center;">
                            <button type="submit" class="btn btn-primary" style="background-color: #6892E3; border-color: #000000; padding: 10px 110px; border-width: 2px; font-size: 15px; border-radius: 0;">
                                {{ __('Confirm Mail') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- @section('content')
<div class="row display: flex; justify-content-center" style="height:100vh;">
    <div class="col-md-6" style="display: flex; align-items: center; justify-content: center;">
        <div class="image" style="background-color: #2A3045; width:100%; top:120px; padding-top:30px; margin-bottom:80px;">
            <img src="{{ asset('images/gambar1.png') }}" alt="Deskripsi gambar">
        </div>
        
    </div>

    <div class="col-md-6">
        <div class="row" style="background-color: #2A3045; display: flex; align-items: center; justify-content: center; height:530px;">
            <div class="col-md-8" style="background-color: white; height: 550px; width: 80%; border-radius: 20px; border: 2px solid #cccccc; margin-top:20px">
                <div class="row">
                    <div class="col-md-12 text-center" style="margin-top: 50px;"> 
                        <div style="font-family: 'Times New Roman', sans-serif; font-size: 30px; font-weight: bold;">
                            <div>{{ __('Forgot Password') }}</div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center" style="margin-top: 10px;">{{ __('Dont worry, we will send you a link to change your password. Please enter your email.') }}</div>
                </div>
                    <div class="container" style="margin-top: 50px; background-color:green">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="background-color: #cccccc;">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 text-center" style="margin-top: 50px;">
                                <div style="display: flex; align-items: center; justify-content: center;">
                                    <button type="submit" class="btn btn-primary" style="background-color: #6892E3; border-color: #000000; padding: 10px 110px; border-width: 2px; font-size: 15px; border-radius: 0;">
                                        {{ __('Confirm Mail') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection -->

