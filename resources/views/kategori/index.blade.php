@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
        <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="text-center">
                            <h2>KATEGORI KARYAWAN - POLITEKNIK NEGERI MALANG</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('kategori.create') }}">Tambah Kategori</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <th width="280px">Aksi</th>
        </tr>
        @foreach ($kategori as $kat)
        <tr>
            <td>{{ $kat->nama_kategori }}</td>
            <td>
                <form action="{{ route('kategori.destroy', $kat->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('kategori.edit', $kat->id) }}">Edit</a>
                    <a class="btn btn-info" href="{{ route('kategori.show', $kat->id) }}">Detail</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin untuk menghapus kategori ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
