<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->char('nis','10');
            $table->char('kd_buku','10');
            $table->char('jumlah_pinjam','3');
            $table->string('ket');
            $table->string('status');
            $table->timestamps();
        });
        Schema::create('tb_pengembalian', function (Blueprint $table) {
            $table->id();
            $table->char('nis','10');
            $table->char('kd_buku','10');
            $table->char('jumlah_pinjam','3');
            $table->string('ket');
            $table->string('status');
            $table->timestamps();
        });
        Schema::create('log_peminjaman', function (Blueprint $table) {
            $table->id();
            $table->char('nis','10');
            $table->char('kd_buku','10');
            $table->char('jumlah_pinjam','3');
            $table->string('ket');
            $table->string('status');
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
        Schema::dropIfExists('tb_peminjaman');
        Schema::dropIfExists('tb_pengembalian');
        Schema::dropIfExists('log_peminjaman');
    }
}
