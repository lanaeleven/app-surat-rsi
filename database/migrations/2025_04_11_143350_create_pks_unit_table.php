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
        Schema::create('perjanjian_kerja_sama_unit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perjanjian_kerja_sama_id')->constrained('perjanjian_kerja_sama')->onDelete('cascade');
            $table->foreignId('unit_id')->constrained('unit')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perjanjian_kerja_sama_unit');
    }
};
