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

                INSERT into log_peminjaman 
                (nis,kd_buku,jumlah_pinjam,ket,status,created_at,updated_at) 
                VALUES 
                (new.nis,new.kd_buku,new.jumlah_pinjam,new.ket,"pinjam",new.created_at,"'.date('Y-m-d').'");
            END
        ');
        DB::unprepared('
        CREATE TRIGGER tr_kembali AFTER DELETE ON tb_peminjaman FOR EACH ROW
            BEGIN
                UPDATE tb_buku SET stok=stok+old.jumlah_pinjam WHERE kd_buku=old.kd_buku;

                INSERT into tb_pengembalian 
                (nis,kd_buku,jumlah_pinjam,ket,status,created_at,updated_at) 
                VALUES 
                (old.nis,old.kd_buku,old.jumlah_pinjam,old.ket,"kembali",old.created_at,"'.date('Y-m-d').'");
                
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
