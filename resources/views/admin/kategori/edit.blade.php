@extends('layouts.app')

@section('content')
<div class="col-md-6" style="padding: 3px 10px; margin-top: 10px;  margin-bottom: 10px;">
    <a href="{{ route('kategori.index') }}" class="btn btn-secondary" style="margin-left: 910px; background-color: #1d83b3; border-color: #000000; padding: 5px 50px; border-width: 2px; font-size: 15px;">Back</a>
</div>
<div class="container" style="margin-left: 250px; background-color: #abdbe3; border-radius: 10px">
<div class="text-left">
    <h2> Update Category </h2>
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
                        <label for="nama_kategori" class="col-md-4 col-form-label text-md-right">Name Category :</label>
                        <div class="col-md-8">
                            <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" value="{{ $kategori->nama_kategori }}" aria-describedby="nama_kategori" style="width: 550px; background-color: #F0F8FF;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary" style="margin-left: 370px; margin-top: 10px; background-color: #1d83b3; border-color: #000000; padding: 5px 50px; border-width: 2px; font-size: 15px;">Save</button>
                </div>
            </div>
        </br>
        </form>
    </div>
</div>
</div>
@endsection