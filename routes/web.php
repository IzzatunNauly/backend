<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Mengarahkan pengguna langsung ke halaman karyawan setelah login
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [KaryawanController::class, 'index'])->name('home');
    
    // Resource route untuk KaryawanController
    Route::resource('karyawan', KaryawanController::class);
    
    // Rute tambahan untuk KaryawanController
    Route::get('/karyawan/show_import', [KaryawanController::class, 'showImportForm'])->name('karyawan.showImportForm');
    Route::post('/karyawan/import', [KaryawanController::class, 'import'])->name('karyawan.import');
    Route::delete('/karyawan/deleteAll', [KaryawanController::class, 'deleteAll'])->name('karyawan.deleteAll');
    
    // Resource route untuk KategoriController
    Route::resource('kategori', KategoriController::class);
});

?>