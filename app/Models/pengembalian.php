<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengembalian extends Model
{
    use HasFactory;
    protected $table = 'tb_pengembalian';
    protected $fillable = ['id_anggota','id_buku','jumlah_pinjam','status','ket'];
}
