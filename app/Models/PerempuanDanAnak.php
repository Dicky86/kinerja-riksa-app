<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerempuanDanAnak extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // Membuka semua kolom untuk diisi kecuali ID
    
    // Opsional: Untuk menghitung sisa tindak lanjut secara otomatis
    public function getSisaTindakLanjutAttribute()
    {
        return $this->target_penanganan - $this->realisasi;
    }
    
    // Opsional: Untuk menghitung sisa kewajiban secara otomatis
    public function getSisaKewajibanAttribute()
    {
        return $this->kewajiban_rp - $this->sudah_dipenuhi_rp;
    }
}