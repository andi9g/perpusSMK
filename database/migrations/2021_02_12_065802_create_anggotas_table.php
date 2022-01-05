<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_anggota', function (Blueprint $table) {
            $table->id();
            $table->char('nis','9')->unique();
            $table->string('namaAnggota','30');
            $table->string('id_jurusan');
            $table->string('password');
            $table->char('noHp','13');
            $table->string('foto')->nullable();
            $table->timestamps();
        });

        Schema::create('daftar_pengunjung', function (Blueprint $table) {
            $table->id();
            $table->char('nis','9');
            $table->timestamps();
        });

        Schema::create('perangkat', function (Blueprint $table) {
            $table->id();
            $table->string('perangkat');
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
        Schema::dropIfExists('tb_anggota');
        Schema::dropIfExists('daftar_pengunjung');
        Schema::dropIfExists('perangkat');
    }
}
