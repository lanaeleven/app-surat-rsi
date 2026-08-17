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
        Schema::table('distribusi_surat', function(Blueprint $table) {
            $table->string('idGroup')->nullable();
            $table->boolean('sudahDijawab')->default(false);
            $table->timestamp('tanggalDijawab')->nullable();
            $table->unsignedBigInteger('idBalasanUntuk')->nullable();
            $table->foreign('idBalasanUntuk')->references('id')->on('distribusi_surat')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('distribusi_surat', function(Blueprint $table) {
            $table->dropForeign(['idBalasanUntuk']);
            $table->dropColumn(['idGroup', 'sudahDijawab', 'tanggalDijawab', 'idBalasanUntuk']);
        });
    }
};
