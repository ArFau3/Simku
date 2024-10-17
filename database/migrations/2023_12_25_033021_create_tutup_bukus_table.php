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
        Schema::create('tutup_bukus', function (Blueprint $table) {
            $table->id();
            $table->date('awal');
            $table->date('akhir')->nullable();
            $table->foreignId('transaksi_id', 20)->nullable();

            $table->foreign('transaksi_id')->references('id')->on('transaksis')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutup_bukus');
    }
};
