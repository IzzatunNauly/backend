<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal_jam'); // Mengubah 'date_time_set' menjadi 'dateTime'
            $table->boolean('is_presence'); // Mengubah 'is_bool' menjadi 'boolean'
            $table->unsignedBigInteger('id_karyawan')->required();
            $table->foreign('id_karyawan')->references('id')->on('karyawan');
            $table->unsignedBigInteger('id_presensi')->required();
            $table->foreign('id_presensi')->references('id')->on('presensi');
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
        Schema::create('rekap', function (Blueprint $table){
            $table->dropColumn('karyawan');
            $table->dropColumn('presensi');
        });
    }
}
