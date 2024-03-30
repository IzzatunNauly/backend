<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPerusahaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_perusahaan', function (Blueprint $table) {
            $table->id(); // Menggunakan increments() sebagai primary key
            $table->text('unique_code');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->string('tlp'); // Mengubah tipe data menjadi string karena nomor telepon biasanya berupa string
            $table->string('email'); // Mengubah tipe data menjadi string untuk email
            $table->string('password'); // Mengubah tipe data menjadi string untuk password
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_perusahaan');
    }
}
