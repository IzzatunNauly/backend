@extends('layouts.app') <!-- Menggunakan layout yang sesuai -->

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
                Edit Karyawan <!-- Mengubah judul -->
            </div>
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
                <form method="post" action="{{ route('karyawan.update', $karyawan->id) }}" id="myForm">
                    @csrf 
                    @method('PUT') <!-- Menggunakan method PUT -->
                    <div class="form-group">
                        <label for="nama">Nama</label> <!-- Mengubah untuk sesuai dengan atribut Karyawan -->
                        <input type="text" name="nama" class="form-control" id="nama" value="{{ $karyawan->nama }}" aria-describedby="nama">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label> <!-- Menambah kolom Alamat -->
                        <input type="text" name="alamat" class="form-control" id="alamat" value="{{ $karyawan->alamat }}" aria-describedby="alamat">
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label> <!-- Menambah kolom Jenis Kelamin -->
                        <input type="text" name="jenis_kelamin" class="form-control" id="jenis_kelamin" value="{{ $karyawan->jenis_kelamin }}" aria-describedby="jenis_kelamin">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label> <!-- Menambah kolom Tanggal Lahir -->
                        <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="{{ $karyawan->tanggal_lahir }}" aria-describedby="tanggal_lahir">
                    </div>
                    <div class="form-group">
                        <label for="tlp">Telepon</label> <!-- Menambah kolom Telepon -->
                        <input type="text" name="tlp" class="form-control" id="tlp" value="{{ $karyawan->tlp }}" aria-describedby="tlp">
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label> <!-- Menambah kolom Foto -->
                        <input type="text" name="foto" class="form-control" id="foto" value="{{ $karyawan->foto }}" aria-describedby="foto">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label> <!-- Menambah kolom Email -->
                        <input type="email" name="email" class="form-control" id="email" value="{{ $karyawan->email }}" aria-describedby="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label> <!-- Menambah kolom Password -->
                        <input type="password" name="password" class="form-control" id="password" value="{{ $karyawan->password }}" aria-describedby="password">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label> <!-- Menambah kolom Kategori -->
                        <input type="text" name="kategori" class="form-control" id="kategori" value="{{ $karyawan->kategori }}" aria-describedby="kategori">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection