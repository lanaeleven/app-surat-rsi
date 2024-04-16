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
        Schema::create('distribusi_surat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idSuratMasuk');
            $table->foreign('idSuratMasuk')->references('id')->on('surat_masuk');
            $table->unsignedBigInteger('idTujuanDisposisi');
            $table->foreign('idTujuanDisposisi')->references('id')->on('tujuan_disposisi');
            $table->date('tanggalDiteruskan');
            $table->string('instruksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribusi_surat');
    }
};
