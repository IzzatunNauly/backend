<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permit', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pengajuan');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('attachment'); // Mengubah 'image' menjadi 'string' sesuai kebutuhan
            $table->unsignedBigInteger('id_karyawan')->required();
            $table->foreign('id_karyawan')->references('id')->on('karyawan');
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
        Schema::create('permit', function (Blueprint $table){
            $table->dropColumn('karyawan');
        });
    }
}
