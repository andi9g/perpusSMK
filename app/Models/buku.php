<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    use HasFactory;
    protected $table = 'tb_buku';
    protected $fillable = ['kd_buku','judul_buku','pengarang','penerbit','tahun','jenis_buku','lokasi_rak','stok'];

}
