<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengaturanPerpus extends Model
{
    use HasFactory;
    protected $table = 'tb_pengaturan';
    protected $fillable = ['nama_perpus','keterlambatan'];
}
