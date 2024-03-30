<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan; // Import model Karyawan
use App\Models\Kategori; // Import model Kategori
use Illuminate\Support\Str;

class KaryawanController extends Controller
{
    /**
     * Menampilkan daftar karyawan.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawan = Karyawan::paginate(10); // Mengambil data karyawan dengan pagination
        return view('karyawan.index', compact('karyawan')); // Menampilkan view index dengan data karyawan
    }

    /**
     * Menampilkan detail karyawan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $karyawan = Karyawan::findOrFail($id); // Mencari karyawan berdasarkan ID
        return view('karyawan.detail', compact('karyawan')); // Menampilkan view detail dengan data karyawan
    }

    public function create()
    {
        $kategori = Kategori::all(); // Mendapatkan semua data kategori
        return view('karyawan.create', compact('kategori')); // Meneruskan data kategori ke view
    }

    /**
     * Menampilkan form untuk mengedit karyawan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id); // Mencari karyawan berdasarkan ID
        return view('karyawan.edit', compact('karyawan')); // Menampilkan view edit dengan data karyawan
    }

    /**
     * Menyimpan data karyawan yang baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'tlp' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Foto harus berupa gambar dengan format tertentu dan maksimum ukuran 2MB
            'email' => 'required',
            'password' => 'required',
            'id_kategori' => 'required', // Pastikan id_kategori yang diperlukan divalidasi
        ]);
    
        // Ambil file foto yang diunggah
        $uploadedImage = $request->file('foto');
    
        // Generate nama unik untuk gambar
        $imageName = Str::random(10) . '.' . $uploadedImage->getClientOriginalExtension();
    
        // Simpan gambar di direktori storage/app/public/foto
        $uploadedImage->storeAs('public/foto', $imageName);
    
        // Buat instance baru dari model Karyawan
        $karyawan = new Karyawan();
        $karyawan->nama = $request->nama;
        $karyawan->alamat = $request->alamat;
        $karyawan->jenis_kelamin = $request->jenis_kelamin;
        $karyawan->tanggal_lahir = $request->tanggal_lahir;
        $karyawan->tlp = $request->tlp;
        $karyawan->foto = $imageName; // Assign the uploaded image name to the model
        $karyawan->email = $request->email;
        $karyawan->password = $request->password;
        $karyawan->id_kategori = $request->id_kategori; // Mengambil id_kategori dari form
    
        // Simpan instance baru Karyawan ke dalam database
        $karyawan->save();
    
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan');
    }    

    /**
     * Mengupdate data karyawan yang sudah diedit.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'tlp' => 'required',
            'email' => 'required',
            'password' => 'required',
            'kategori' => 'required',
        ]);

        $karyawan = Karyawan::findOrFail($id); // Mencari karyawan berdasarkan ID
        $karyawan->update($request->all()); // Mengupdate data karyawan
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diupdate'); // Redirect ke index dengan pesan sukses
    }

    /**
     * Menghapus data karyawan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id); // Mencari karyawan berdasarkan ID
        $karyawan->delete(); // Menghapus data karyawan
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus'); // Redirect ke index dengan pesan sukses
    }
}