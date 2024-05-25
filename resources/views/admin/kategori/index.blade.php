@extends('layouts.app')

@section('content')
<div class="container" style="margin-left: 250px; margin-top: 30px">
    <form action="{{ route('kategori.index') }}" method="GET" style="display: flex; align-items: center;" id="search-form">
        <div class="input-group mb-3" style="flex-grow: 1; margin-top: 20px; margin-right: 10px;">
            <input type="text" class="form-control" placeholder="Search..." name="search" id="search-input" value="{{ request()->get('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" style="background-color: #1d83b3; border-color: #000000; padding: 5px 30px; border-width: 2px; font-size: 15px; color: white;">
                    <i class="fas fa-search" style="margin-right: 5px;"></i>
                    Search
                </button>
            </div>
        </div>
        <div style="margin-left: auto; display: flex;">
            <a class="btn btn-success" style="background-color: #1d83b3; border-color: #000000; padding: 5px 30px; border-width: 2px; font-size: 15px; margin-right: 10px;" href="{{ route('kategori.create') }}">Create</a>
        </div>
    </form>

    <!-- Modal HTML -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <img src="images\warning.png" alt="Warning" style="display: block; margin: 0 auto; width: 150px;">
            <p style="text-align: center;">Are you sure you deleted the following User data?</p>
            <div class="modal-buttons">
                <button class="confirm" id="confirmDeleteBtn">Yes</button>
                <button class="cancel" id="cancelDeleteBtn">Cancel</button>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    <style>
        /* Gaya CSS untuk tabel */
        table {
            font-family: 'Lato', sans-serif; /* Menggunakan font Lato */
            border-collapse: collapse;
            width: 100%;
            border: 2px solid black; /* Menambahkan radius ke tabel */
            overflow: hidden; /* Menghindari overflow dari elemen dengan radius */
        }

        th, td {
            font-size: 14px; /* Mengatur ukuran teks */
            text-align: center;
            padding: 8px;
            border-bottom: 1px solid black;
        }

        th {
            font-size: 16px;
            background-color: #1d83b3; /* Warna abu-abu untuk header */
            color: white; /* Warna teks putih */
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border: 2px solid black;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .modal-buttons button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .modal-buttons .confirm {
            background-color: red;
            color: white;
        }

        .modal-buttons .cancel {
            background-color: #1d83b3;
            color: white;
        }
    </style>
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th width="280px">Aksi</th>
        </tr>
        @foreach ($kategori as $key => $kat)
        <tr>
            <td>{{$kategori->firstItem() + $key}}</td>
            <td>{{ $kat->nama_kategori }}</td>
            <td>
                <form id="deleteForm{{ $kat->id }}" action="{{ route('kategori.destroy', $kat->id) }}" method="POST">
                    <a href="{{ route('kategori.edit', $kat->id) }}"><i class="fas fa-pencil-alt text-dark" style="margin-right: 30px; font-size: 18px;"></i></a>
                    <a href="{{ route('kategori.show', $kat->id) }}"><i class="fas fa-cog text-dark" style="margin-right: 30px; font-size: 18px;"></i></a>
                    @csrf
                    @method('DELETE')
                    <a type="button" onclick="confirmDelete('{{ $kat->id }}')">
                        <i class="fas fa-trash-alt text-dark" style="margin-right: 30px; text-align: center; font-size: 18px;"></i>
                    </a>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div style="margin-top: 10px;">
        Showing
        {{ $kategori->firstItem() }}
        to
        {{ $kategori->lastItem() }}
        of
        {{ $kategori->total() }}
        results
        <div style="float: right;">
            {{ $kategori->links() }}
        </div>
    </div>
</div>

<script>
  function confirmDelete(kategoriId) {
    var modal = document.getElementById('deleteModal');
    var span = document.getElementsByClassName('close')[0];
    var confirmBtn = document.getElementById('confirmDeleteBtn');
    var cancelBtn = document.getElementById('cancelDeleteBtn');

    modal.style.display = 'block';

    // Jika tombol "Yes" ditekan, submit form penghapusan
    confirmBtn.onclick = function() {
      document.getElementById('deleteForm' + kategoriId).submit();
    };

    // Jika tombol "No" atau "X" ditekan, tutup modal
    span.onclick = function() {
      modal.style.display = 'none';
    };

    cancelBtn.onclick = function() {
      modal.style.display = 'none';
    };

    // Tutup modal jika klik di luar modal
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = 'none';
      }
    };
  }
</script>
@endsection