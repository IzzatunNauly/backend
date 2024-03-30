<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// class CreateKaryawanTable extends Migration
// {
//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         Schema::create('karyawan', function (Blueprint $table) {
//             $table->id();
//             $table->unsignedBigInteger('id_kategori')->required();
//             $table->foreign('id_kategori')->references('id')->on('kategori');
//             // $table->unsignedBigInteger('id_admin')->required();
//             // $table->foreign('id_admin')->references('id')->on('admin_perusahaan');
//             // $table->text('unique_code');
//             $table->string('nama');
//             $table->text('alamat');
//             $table->string('jenis_kelamin');
//             $table->date('tanggal_lahir');
//             $table->text('tlp');
//             $table->string('foto');
//             $table->string('kategori');
//             $table->text('email');
//             $table->text('password');
//             $table->timestamps();
//         });
//     }

//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down(): void
//     {
//         Schema::create('karyawan', function (Blueprint $table){
//             $table->dropColumn('kategori');
//             $table->dropColumn('admin_perusahaan');
//         });
//     }
// }
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kategori');
            $table->foreign('id_kategori')->references('id')->on('kategori');
            $table->string('nama');
            $table->text('alamat');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->text('tlp');
            $table->string('foto');
            $table->text('email');
            $table->text('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
}
