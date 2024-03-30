@extends('layouts.app')

@section('content')
<div class="container">
<div class="row mb-3">
        <div class="col-md-6">
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
<div class="text-center">
    <h2> EDIT KATEGORI </h2>
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
        <form method="post" action="{{ route('kategori.update', $kategori->id) }}" id="myForm">
            @csrf 
            @method('PUT')
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group row">
                        <label for="nama_kategori" class="col-md-4 col-form-label text-md-right">Nama Kategori</label>
                        <div class="col-md-8">
                            <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" value="{{ $kategori->nama_kategori }}" aria-describedby="nama_kategori">
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