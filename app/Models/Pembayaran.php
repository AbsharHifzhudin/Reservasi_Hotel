<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_kamar',
        'metode_pembayaran',
        'waktu_pembayaran',
        'total_uang_diterima',
        'harga_total',
        'kembalian',
        'konfirmasi_pembayaran',
    ];
}
