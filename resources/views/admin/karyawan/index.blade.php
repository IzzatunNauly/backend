@extends('layouts.app')

@section('content')
<div class="container" style="margin-left: 250px; margin-top: 30px">
    <form action="{{ route('karyawan.index') }}" method="GET" style="display: flex; align-items: center;" id="search-form">
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
            <a class="btn btn-success" style="background-color: #1d83b3; border-color: #000000; padding: 5px 30px; border-width: 2px; font-size: 15px; margin-right: 10px;" href="{{ route('karyawan.create') }}">Create</a>
            <button type="submit" class="btn btn-primary" style="background-color: #1d83b3; border-color: #000000; padding: 5px 30px; border-width: 2px; font-size: 15px; margin-right: 10px;" onclick="document.getElementById('csv_file').click();">Import</button>
            <button type="button" class="btn btn-danger" style="border-color: #000000; padding: 5px 30px; border-width: 2px; font-size: 15px;" onclick="showDeleteAllModal()">Delete</button>
        </div>
    </form>

    <!-- Form untuk import CSV, disembunyikan -->
    <form id="importForm" action="{{ route('karyawan.import') }}" method="POST" enctype="multipart/form-data" style="display: none;">
        @csrf
        <input type="file" id="csv_file" name="csv_file" onchange="document.getElementById('importForm').submit();">
    </form>

    <!-- Modal HTML -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <img src="images/warning.png" alt="Warning" style="display: block; margin: 0 auto; width: 150px;">
            <p style="text-align: center;">Are you sure you want to delete all employee data?</p>
            <div class="modal-buttons">
                <form id="deleteAllForm" action="{{ route('karyawan.deleteAll') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="confirm">Yes</button>
                </form>
                <button class="cancel" onclick="closeDeleteAllModal()">Cancel</button>
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
            overflow: hidden; /* Menghindari overflow dari elemen dengan radius */
            border: 2px solid black;
        }

        th, td {
            font-size: 12px; /* Mengatur ukuran teks */
            text-align: center;
            padding: 8px;
            border-bottom: 1px solid black;
        }

        th {
            font-size: 14px;
            background-color: #1d83b3; /* Warna untuk header */
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
            <th>Name</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Date</th>
            <th>Telephone</th>
            <th>Image</th>
            <th>Email</th>
            <th>Category</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($karyawan as $key => $kar)
            <tr>
                <td>{{ $karyawan->firstItem() + $key}}</td> <!-- Menampilkan nomor urut -->
                <td>{{ $kar->nama }}</td>
                <td>{{ $kar->alamat }}</td>
                <td>{{ $kar->jenis_kelamin }}</td>
                <td>{{ date('d F Y', strtotime($kar->tanggal_lahir)) }}</td>
                <td>{{ $kar->tlp }}</td>
                <td>
                    @if ($kar->foto)
                        <img src="{{ asset('storage/foto/' . $kar->foto) }}" alt="Foto Karyawan" style="max-width: 50px; border-radius: 50%;">
                    @else
                        <span>Tidak ada foto</span>
                    @endif
                </td>
                <td>{{ $kar->email }}</td>
                <td>{{ optional($kar->kategori)->nama_kategori }}</td>
                <td>
                    <form id="deleteForm{{ $kar->id }}" action="{{ route('karyawan.destroy', $kar->id) }}" method="POST">
                        <a href="{{ route('karyawan.edit', $kar->id) }}">
                            <i class="fas fa-pencil-alt text-dark" style="margin-right: 30px; text-align: center; font-size: 18px;"></i>
                        </a>
                        @csrf
                        @method('DELETE')
                        <a type="button" onclick="confirmDelete('{{ $kar->id }}', '{{ $kar->nama }}')">
                            <i class="fas fa-trash-alt text-dark" style="margin-right: 30px; text-align: center; font-size: 18px;"></i>
                        </a>
                    </form>
                </td>
            </tr>
            @endforeach
    </table>
    <div style="margin-top: 10px;">
        Showing
        {{ $karyawan->firstItem() }}
        to
        {{ $karyawan->lastItem() }}
        of
        {{ $karyawan->total() }}
        results
        <div style="float: right;">
            {{ $karyawan->links() }}
        </div>
    </div>
</div>

<script>
   function confirmDelete(karyawanId, karyawanName) {
    var modal = document.getElementById('deleteModal');
    var span = document.getElementsByClassName('close')[0];
    var confirmBtn = document.querySelector('#deleteModal .confirm');
    var cancelBtn = document.querySelector('#deleteModal .cancel');

    modal.style.display = 'block';

    // Jika tombol "Yes" ditekan, submit form penghapusan
    confirmBtn.onclick = function() {
        document.getElementById('deleteForm' + karyawanId).submit();
    };

    // Menampilkan pesan konfirmasi dengan nama pengguna yang akan dihapus
    document.querySelector('#deleteModal p').innerText = 'Are you sure you want to delete employee ' + karyawanName + '?';

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

    function showDeleteAllModal() {
        var modal = document.getElementById('deleteModal');
        // Memeriksa apakah ada karyawan yang tersedia
        var karyawanRows = document.querySelectorAll('table tr').length - 1; // Mengurangi 1 untuk baris header
        if (karyawanRows > 0) {
            modal.style.display = 'block';
        } else {
            alert('No employee found for deletion.');
        }
    }

  function closeDeleteAllModal() {
    var modal = document.getElementById('deleteModal');
    modal.style.display = 'none';
  }

  document.getElementById('search-form').addEventListener('submit', function(event) {
    var searchInput = document.getElementById('search-input').value.trim();
    if (searchInput === '') {
        event.preventDefault();
        window.location.href = "{{ route('karyawan.index') }}";
    }
});
</script>
@endsection
