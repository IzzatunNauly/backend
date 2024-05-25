@extends('layouts.app')

@section('content')
<div class="col-md-6"  style="padding: 3px 10px; margin-top: 10px;  margin-bottom: 10px;">
    <a href="{{ route('karyawan.index') }}" class="btn btn-secondary" style="margin-left: 930px; background-color: #1d83b3; border-color: #000000; padding: 5px 50px; border-width: 2px; font-size: 15px;">Back</a>
</div>
<div class="container" style="margin-left: 250px; background-color: #abdbe3; border-radius: 10px;">
    <div class="text-left">
        <h2> Update Users </h2>
    </div>
    <div class="container mt-5">
        <div class="card-body">
            @if ($errors->any()) 
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error) 
                    <li>{{ $error }}</li>
                    @endforeach 
                </ul>
            </div>
            @endif 
            <form method="post" action="{{ route('karyawan.update', $karyawan->id) }}" id="myForm" enctype="multipart/form-data">
                @csrf 
                @method('PUT')
                <div class="row">
                    <div class="col-md-10">
                        <!-- Form fields here -->
                        <!-- Name -->
                        <div class="form-group row">
                            <label for="nama" class="col-md-4 col-form-label text-md-right">Name :</label>
                            <div class="col-md-8">
                                <input type="text" name="nama" class="form-control" id="nama" value="{{ $karyawan->nama }}" aria-describedby="nama" style="width: 550px; background-color: #F0F8FF;">
                            </div>
                        </div>
                        <br/>
                        <!-- Address -->
                        <div class="form-group row">
                            <label for="alamat" class="col-md-4 col-form-label text-md-right">Address :</label>
                            <div class="col-md-8">
                                <input type="text" name="alamat" class="form-control" id="alamat" value="{{ $karyawan->alamat }}" aria-describedby="alamat" style="width: 550px; background-color: #F0F8FF;">
                            </div>
                        </div>
                        <br/>
                        <!-- Gender -->
                        <div class="form-group row">
                            <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-right">Gender :</label>
                            <div class="col-md-8">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" style="margin-right: 10px; background-color: black; width: 20px; height: 20px; border-color: #000000;" type="radio" name="jenis_kelamin" id="jenis_kelamin_laki" value="L" {{ $karyawan->jenis_kelamin == 'L' ? 'checked' : '' }}>
                                    <label class="form-check-label" style="margin-right: 200px;" for="jenis_kelamin_laki">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" style="margin-right: 10px; background-color: black; width: 20px; height: 20px; border-color: #000000;" type="radio" name="jenis_kelamin" id="jenis_kelamin_perempuan" value="P" {{ $karyawan->jenis_kelamin == 'P' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="jenis_kelamin_perempuan">Female</label>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <!-- Date of Birth -->
                        <div class="form-group row">
                            <label for="tanggal_lahir" class="col-md-4 col-form-label text-md-right">Date :</label>
                            <div class="col-md-8">
                                <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="{{ $karyawan->tanggal_lahir }}" aria-describedby="tanggal_lahir" style="width: 550px; background-color: #F0F8FF;">
                            </div>
                        </div>
                        <br/>
                        <!-- Telephone -->
                        <div class="form-group row">
                            <label for="tlp" class="col-md-4 col-form-label text-md-right">Telephone :</label>
                            <div class="col-md-8">
                                <input type="text" name="tlp" class="form-control" id="tlp" value="{{ $karyawan->tlp }}" aria-describedby="tlp" style="width: 550px; background-color: #F0F8FF;">
                            </div>
                        </div>
                        <br/>
                        <!-- Image -->
                        <div class="form-group row">
                            <label for="foto" class="col-md-4 col-form-label text-md-right">Image :</label>
                            <div class="col-md-8">
                                <input type="file" name="foto" class="form-control-file" id="foto" accept="image/*" aria-describedby="foto" style="width: 550px; background-color: #F0F8FF;">
                                <small id="foto" class="form-text text-muted">Silakan pilih foto dari perangkat Anda.</small>
                            </div>
                        </div>
                        <br/>
                        <!-- Email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email :</label>
                            <div class="col-md-8">
                                <input type="email" name="email" class="form-control" id="email" value="{{ $karyawan->email }}" aria-describedby="email" style="width: 550px; background-color: #F0F8FF;">
                            </div>
                        </div>
                        <br/>
                        <!-- Password -->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password :</label>
                            <div class="col-md-8">
                                <input type="text" name="password" class="form-control" id="password" value="{{ $karyawan->password }}" aria-describedby="password" style="width: 550px; background-color: #F0F8FF;">
                            </div>
                        </div>
                        <br/>
                        <!-- Category -->
                        <div class="form-group row">
                            <label for="id_kategori" class="col-md-4 col-form-label text-md-right">Category :</label>
                            <div class="col-md-8">
                                <select name="id_kategori" class="form-control" id="id_kategori" aria-describedby="kategori" style="width: 550px; background-color: #F0F8FF;">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategori as $kat)
                                        <option value="{{ $kat->id }}" {{ $karyawan->id_kategori == $kat->id ? 'selected' : '' }}>
                                            {{ $kat->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Save button -->
                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" style="margin-left: 370px; margin-top: 10px; background-color: #1d83b3; border-color: #000000; padding: 5px 50px; border-width: 2px; font-size: 15px;">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection