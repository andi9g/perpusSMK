<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_admin', function (Blueprint $table) {
            $table->id();
            $table->string('nama_admin');
            $table->char('username','10')->unique();
            $table->string('password');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
        
        DB::table('tb_admin')->insert([
            'nama_admin' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('admin12345'),
            'foto' => ''
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_admin');
    }
}
