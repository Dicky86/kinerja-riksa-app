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
    Schema::create('penanganan_ijazah', function (Blueprint $table) {
        $table->id();
        $table->string('status_tindak_lanjut', 50)->nullable();
        $table->string('perusahaan');
        $table->date('tanggal')->nullable();
        $table->string('provinsi', 100)->nullable();
        $table->unsignedInteger('jumlah_ijazah_ditahan')->default(0);
        $table->unsignedInteger('jumlah_pengembalian_ijazah')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penanganan_ijazah');
    }
};
