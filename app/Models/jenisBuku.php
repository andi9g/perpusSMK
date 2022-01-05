<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenisBuku extends Model
{
    use HasFactory;
    protected $table = 'jenis_buku';
    protected $fillable = ['jenis_buku'];
}
