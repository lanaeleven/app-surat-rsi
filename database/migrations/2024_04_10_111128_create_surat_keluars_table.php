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
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idJenisSurat');
            $table->foreign('idJenisSurat')->references('id')->on('jenis_surat');
            $table->unsignedBigInteger('idDireksi');
            $table->foreign('idDireksi')->references('id')->on('direksi');
            $table->date('tanggalSurat');
            $table->string('tujuan');
            $table->string('perihal');
            $table->string('keterangan');
            $table->string('fileName');
            $table->string('filePath');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};
