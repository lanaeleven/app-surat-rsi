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
        Schema::create('informasi_unit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('informasi_id')->constrained('informasi')->onDelete('cascade');
            $table->foreignId('unit_id')->constrained('unit')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_unit');
    }
};
