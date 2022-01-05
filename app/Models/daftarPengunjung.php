<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class daftarPengunjung extends Model
{
    use HasFactory;
    protected $table = 'daftar_pengunjung';
    protected $fillable = ['nis'];
}
