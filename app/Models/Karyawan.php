<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Karyawan extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'karyawan'; // Nama tabel Karyawan

    protected $primaryKey = 'id'; // Primary key

    protected $fillable = [
        'nama',
        'alamat',
        'jenis_kelamin',
        'tanggal_lahir',
        'tlp',
        'foto',
        'email',
        'password',
        'id_kategori', // Menambahkan id_kategori ke dalam $fillable
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Di dalam model Karyawan
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }

    // Validasi saat menyimpan data
    public static $rules = [
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan', // Misalnya hanya menerima Laki-laki atau Perempuan
        'tanggal_lahir' => 'required|date',
        'tlp' => 'required|string|max:20',
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Foto harus berupa gambar dengan format tertentu dan maksimum ukuran 2MB
        'email' => 'required|string|email|max:255|unique:karyawan',
        'password' => 'required|string|min:8',
        'id_kategori' => 'required|exists:kategori,id',
    ];
}