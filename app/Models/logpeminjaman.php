<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logpeminjaman extends Model
{
    use HasFactory;
    protected $table = 'log_peminjaman';
    protected $fillable = ['id_anggota','id_buku','jumlah_pinjam','status','ket'];
}
