<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->id(); // Menggunakan increments() sebagai primary key
            $table->string('nama_presensi');
            $table->dateTime('first_attendance'); // Mengubah 'date_time_set' menjadi 'dateTime'
            $table->dateTime('finish_attendance'); // Mengubah 'date_time_set' menjadi 'dateTime'
            $table->unsignedBigInteger('id_kategori')->required();
            $table->foreign('id_kategori')->references('id')->on('kategori');
            $table->unsignedBigInteger('id_admin')->required();
            $table->foreign('id_admin')->references('id')->on('admin_perusahaan');
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
        Schema::create('presensi', function (Blueprint $table){
            $table->dropColumn('kategori');
            $table->dropColumn('admin_perusahaan');
        });
    }
}
