<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anggota extends Model
{
    use HasFactory;
    protected $table = 'tb_anggota';
    protected $fillable = ['nis','namaAnggota','id_jurusan','password','no_hp','foto'];
    
}
