<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kompensasi_tka', function (Blueprint $table) {
            $table->id();

            $table->string('no_surat')->index();
            $table->date('tanggal_surat')->nullable();
            $table->string('perusahaan');
            $table->string('provinsi')->nullable();
            $table->decimal('nominal_pembayaran_kompensasi', 15, 2)
                ->default(0);
            $table->string('status')->nullable();
            $table->unsignedInteger('jumlah_pekerja')->default(0);

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kompensasi');
    }
};
