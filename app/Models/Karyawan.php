<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // Menggunakan Model sebagai parent class
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
}