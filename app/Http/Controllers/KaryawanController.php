<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Csv\Reader;
use League\Csv\Statement;
use Illuminate\Http\Request;
use App\Models\Karyawan; // Import model Karyawan
use App\Models\Kategori; // Import model Kategori


class KaryawanController extends Controller
{
    /**
     * Menampilkan daftar karyawan.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $karyawan = Karyawan::where('nama', 'like', '%'.$search.'%')
                    ->orWhere('alamat', 'like', '%'.$search.'%')
                    ->orWhere('jenis_kelamin', 'like', '%'.$search.'%')
                    ->orWhere('tlp', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhereHas('kategori', function($query) use ($search) {
                        $query->where('nama_kategori', 'like', '%'.$search.'%');
                    })
                    ->paginate(4); // Mengubah dari 10 ke 5$paginator->currentPage()

        return view('admin/karyawan.index', compact('karyawan'));
    }

    public function setting(Request $request)
    {
        // Validasi input
        $request->validate([
            'attendance' => 'required',
            'first_attendance' => 'required',
            'finish_attendance' => 'required',
        ]);

        // Simpan data setting ke dalam database
        $setting = new Setting();
        $setting->attendance = $request->attendance;
        $setting->first_attendance = $request->first_attendance;
        $setting->finish_attendance = $request->finish_attendance;
        $setting->save();

        // Redirect ke halaman setting dengan pesan sukses
        return redirect()->back()->with('success', 'Setting berhasil disimpan');
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
        $kategori = Kategori::all(); // Mengambil semua data kategori
        return view('admin/karyawan.detail', compact('karyawan', 'kategori')); // Menampilkan view detail dengan data karyawan dan kategori
    }

    public function create()
    {
        $kategori = Kategori::all(); // Mendapatkan semua data kategori
        return view('admin/karyawan.create', compact('kategori')); // Meneruskan data kategori ke view
    }

    /**
     * Menampilkan form untuk mengedit karyawan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $kategori = Kategori::all(); // Mendapatkan semua kategori
        return view('admin/karyawan.edit', compact('karyawan', 'kategori'));
    }

    public function showImportForm()
    {
        return view('admin.karyawan.import');
    }
    
    // Metode lainnya tetap sama seperti sebelumnya

    public function import(Request $request)
{
    // dd("its's here"); // Hapus atau komentari baris ini untuk melanjutkan eksekusi

    // Validasi file CSV yang diunggah
    $request->validate([
        'csv_file' => 'required|mimes:csv,xls,xlsx,txt|max:2048',
    ]);

    // Ambil file CSV yang diunggah
    $uploadedCSV = $request->file('csv_file');

    // Buka file CSV menggunakan League CSV
    $reader = Reader::createFromPath($uploadedCSV->getPathname(), 'r');

    // Set delimiter jika diperlukan
    $reader->setDelimiter(',');

    // Baca baris data dari file CSV
    $stmt = (new Statement())->offset(1);
    $records = $stmt->process($reader);

    // Proses setiap baris data
    foreach ($records as $record) {
        // Validasi setiap baris data jika diperlukan
        // Pastikan baris data sesuai dengan aturan validasi yang telah ditentukan
        // Misalnya: nama harus ada, alamat harus ada, dll.

        // Buat instance baru dari model Karyawan
        $karyawan = new Karyawan();
        $karyawan->nama = $record[0];
        $karyawan->alamat = $record[1];
        $karyawan->jenis_kelamin = $record[2];
        $karyawan->tanggal_lahir = $record[3];
        $karyawan->tlp = $record[4];
        // Proses pengunggahan foto jika diperlukan
        $karyawan->foto = $this->importFoto($record[5]); // Anda perlu mengubah ini sesuai dengan struktur CSV Anda
        $karyawan->email = $record[6];
        $karyawan->password = $record[7];
        $karyawan->id_kategori = $record[8];

        // Simpan instance baru Karyawan ke dalam database
        $karyawan->save();
    }

    // Redirect ke index dengan pesan sukses
    return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diimpor.');
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


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'tlp' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'id_kategori' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi untuk gambar
        ]);

        $karyawan = Karyawan::find($id);

        $karyawan->nama = $request->get('nama');
        $karyawan->alamat = $request->get('alamat');
        $karyawan->jenis_kelamin = $request->get('jenis_kelamin');
        $karyawan->tanggal_lahir = $request->get('tanggal_lahir');
        $karyawan->tlp = $request->get('tlp');
        $karyawan->email = $request->get('email');
        $karyawan->password = $request->get('password');
        $karyawan->id_kategori = $request->get('id_kategori');

        if ($request->hasFile('foto')) {
            // Menghapus foto lama jika ada
            if ($karyawan->foto && file_exists(storage_path('app/public/foto/' . $karyawan->foto))) {
                Storage::delete('public/foto/' . $karyawan->foto);
            }

            // Mengunggah foto baru
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/foto', $filename);
            $karyawan->foto = $filename;
        }

        $karyawan->save();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan updated successfully');
    }


    /**
     * Menghapus data karyawan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $karyawan = Karyawan::findOrFail($id); // Mencari karyawan berdasarkan ID
            $karyawan->delete(); // Menghapus data karyawan
            return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus'); // Redirect ke index dengan pesan sukses
        } catch (\Exception $e) {
            // Menangani kesalahan jika terjadi
            return redirect()->route('karyawan.index')->with('error', 'Gagal menghapus karyawan: ' . $e->getMessage());
        }
    }

    public function deleteAll()
    {
        try {
            // Menghapus semua baris satu per satu
            Karyawan::query()->delete();

            return redirect()->route('karyawan.index')->with('success', 'Semua data karyawan berhasil dihapus.');
        } catch (\Exception $e) {
            // Menangani kesalahan jika terjadi
            return redirect()->route('karyawan.index')->with('error', 'Gagal menghapus data karyawan: ' . $e->getMessage());
        }
    }

}