<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;
    protected $table = 'sekolah';

    protected $fillable = [
    	'id',
        'nis',
        'nama_sekolah',
        'alamat_sekolah',
    ];
}
