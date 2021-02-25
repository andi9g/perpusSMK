<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Triggerku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_pinjam AFTER INSERT ON tb_peminjaman FOR EACH ROW
            BEGIN
                UPDATE tb_buku SET stok=stok-NEW.jumlah_pinjam WHERE kd_buku=NEW.kd_buku;
            END
        ');
        DB::unprepared('
        CREATE TRIGGER tr_kembali AFTER UPDATE ON tb_peminjaman FOR EACH ROW
            BEGIN
                UPDATE tb_buku SET stok=stok+old.jumlah_pinjam WHERE kd_buku=old.kd_buku;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER tr_pinjam');
        DB::unprepared('DROP TRIGGER tr_kembali');
    }
}
