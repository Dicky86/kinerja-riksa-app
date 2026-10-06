<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perempuan_dan_anaks', function (Blueprint $table) {
            $table->id();
            // Berdasarkan kolom di tabel UI
            $table->date('periode'); // Format tanggal untuk memudahkan filter/grafik
            $table->string('unit_kerja'); // cth: UPT Bandung
            $table->string('jenis_data'); // cth: Pengaduan perempuan dan anak
            
            // Berdasarkan KPI dan data tabel
            $table->integer('jumlah_kasus')->default(0);
            $table->integer('target_penanganan')->default(0);
            $table->integer('realisasi')->default(0);
            
            // Berdasarkan KPI Kewajiban dan Pemenuhan (dalam Rupiah)
            $table->bigInteger('kewajiban_rp')->default(0); 
            $table->bigInteger('sudah_dipenuhi_rp')->default(0);
            
            $table->string('status'); // cth: Valid, Perlu Verifikasi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perempuan_dan_anaks');
    }
};