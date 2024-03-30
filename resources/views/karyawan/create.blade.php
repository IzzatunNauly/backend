@extends('layouts.app')

@section('content')
<div class="container">
<div class="row mb-3">
        <div class="col-md-6">
            <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
<div class="text-center">
    <h2> TAMBAH KARYAWAN </h2>
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
        <form method="post" action="{{ route('karyawan.store') }}" id="myForm">
            @csrf 
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group row">
                        <label for="nama" class="col-md-4 col-form-label text-md-right">Nama</label>
                        <div class="col-md-8">
                            <input type="text" name="nama" class="form-control" id="nama" aria-describedby="nama">
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="alamat" class="col-md-4 col-form-label text-md-right">Alamat</label>
                        <div class="col-md-8">
                            <input type="text" name="alamat" class="form-control" id="alamat" aria-describedby="alamat">
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-right">Jenis Kelamin</label>
                        <div class="col-md-8">
                            <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" aria-describedby="jenis_kelamin">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="tanggal_lahir" class="col-md-4 col-form-label text-md-right">Tanggal Lahir</label>
                        <div class="col-md-8">
                            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" aria-describedby="tanggal_lahir">
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="tlp" class="col-md-4 col-form-label text-md-right">Telepon</label>
                        <div class="col-md-8">
                            <input type="text" name="tlp" class="form-control" id="tlp" aria-describedby="tlp">
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="foto" class="col-md-4 col-form-label text-md-right">Foto</label>
                        <div class="col-md-8">
                            <input type="file" name="foto" class="form-control-file" id="foto" aria-describedby="foto">
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                        <div class="col-md-8">
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="email">
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                        <div class="col-md-8">
                            <input type="password" name="password" class="form-control" id="password" aria-describedby="password">
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="id_kategori" class="col-md-4 col-form-label text-md-right">Kategori</label>
                        <div class="col-md-8">
                            <select name="id_kategori" class="form-control" id="id_kategori" aria-describedby="kategori">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
