@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="text-center">
                            <h2>KARYAWAN - POLITEKNIK NEGERI MALANG</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('karyawan.create') }}">Tambah Karyawan</a>
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
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Lahir</th>
            <th>Telepon</th>
            <th>Foto</th>
            <th>Email</th>
            <th>Kategori</th>
            <th width="280px">Aksi</th>
        </tr>
        @foreach ($karyawan as $kar)
        <tr>
            <td>{{ $kar->nama }}</td>
            <td>{{ $kar->alamat }}</td>
            <td>{{ $kar->jenis_kelamin }}</td>
            <td>{{ date('d F Y', strtotime($kar->tanggal_lahir)) }}</td>
            <td>{{ $kar->tlp }}</td>
            <td>
                @if ($kar->foto)
                    <img src="{{ asset('storage/' . $kar->foto) }}" alt="Foto Karyawan" style="max-width: 100px;">
                @else
                    <span>Tidak ada foto</span>
                @endif
            </td>
            <td>{{ $kar->email }}</td>
            <td>{{ optional($kar->kategori)->nama_kategori }}</td>
            <td>
                <form id="deleteForm{{ $kar->id }}" action="{{ route('karyawan.destroy', $kar->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('karyawan.edit', $kar->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDelete('{{ $kar->id }}')" class="btn btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

<script>
    function confirmDelete(karyawanId) {
        if (confirm('Apakah Anda yakin ingin menghapus data karyawan ini?')) {
            document.getElementById('deleteForm' + karyawanId).submit();
        }
    }
</script>
@endsection
