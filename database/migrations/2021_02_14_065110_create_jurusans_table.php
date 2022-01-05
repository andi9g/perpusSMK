<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurusansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurusan', function (Blueprint $table) {
            $table->id();
            $table->string('jurusan')->unique();
            $table->timestamps();
        });

        Schema::create('jenis_buku', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_buku')->unique();
            $table->timestamps();
        });

        Schema::create('tb_pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perpus');
            $table->string('keterlambatan');
            $table->timestamps();
        });
        Schema::create('tb_logo', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
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
        Schema::dropIfExists('jurusan');
        Schema::dropIfExists('jenis_buku');
        Schema::dropIfExists('tb_pengaturan');
        Schema::dropIfExists('tb_logo');
    }
}
