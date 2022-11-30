<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_kamar',
        'nama_kamar',
        'kapasitas',
        'harga_kamar',
        'jenis_kamar',
        'status_booking',
    ];
}
