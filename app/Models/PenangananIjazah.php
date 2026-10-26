<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenangananIjazah extends Model
{
    protected $table = 'penanganan_ijazah';

    protected $fillable = [
        'status_tindak_lanjut',
        'perusahaan',
        'tanggal',
        'provinsi',
        'jumlah_ijazah_ditahan',
        'jumlah_pengembalian_ijazah',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah_ijazah_ditahan' => 'integer',
        'jumlah_pengembalian_ijazah' => 'integer',
    ];
}
