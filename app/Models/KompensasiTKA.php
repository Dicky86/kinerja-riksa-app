<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KompensasiTKA extends Model
{
    protected $table = 'kompensasi_tka';

    protected $fillable = [
        'no_surat',
        'tanggal_surat',
        'perusahaan',
        'provinsi',
        'nominal_pembayaran_kompensasi',
        'status',
        'jumlah_pekerja',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'nominal_pembayaran_kompensasi' => 'decimal:2',
        'jumlah_pekerja' => 'integer',
    ];
}
