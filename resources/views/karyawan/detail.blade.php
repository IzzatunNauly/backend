@extends('layouts.app') <!-- Menggunakan layout yang sesuai -->

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
                Detail Karyawan <!-- Mengubah judul -->
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>ID: </b>{{ $karyawan->id }}</li> <!-- Mengubah Nim menjadi ID -->
                    <li class="list-group-item"><b>Nama: </b>{{ $karyawan->nama }}</li>
                    <li class="list-group-item"><b>Alamat: </b>{{ $karyawan->alamat }}</li> <!-- Menambah kolom Alamat -->
                    <li class="list-group-item"><b>Jenis Kelamin: </b>{{ $karyawan->jenis_kelamin }}</li> <!-- Menambah kolom Jenis Kelamin -->
                    <li class="list-group-item"><b>Tanggal Lahir: </b>{{ $karyawan->tanggal_lahir }}</li> <!-- Menambah kolom Tanggal Lahir -->
                    <li class="list-group-item"><b>Telepon: </b>{{ $karyawan->tlp }}</li> <!-- Menambah kolom Telepon -->
                    <li class="list-group-item"><b>Foto: </b>{{ $karyawan->foto }}</li> <!-- Menambah kolom Foto -->
                    <li class="list-group-item"><b>Email: </b>{{ $karyawan->email }}</li> <!-- Menambah kolom Email -->
                    <li class="list-group-item"><b>Kategori: </b>{{ $karyawan->kategori }}</li> <!-- Menambah kolom Kategori -->
                </ul>
            </div>
            <a class="btn btn-success mt-3" href="{{ route('karyawan.index') }}">Kembali</a> <!-- Menggunakan route untuk kembali ke index -->
        </div>
    </div>
</div>
@endsection