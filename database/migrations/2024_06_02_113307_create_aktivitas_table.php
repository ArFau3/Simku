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
        Schema::create('aktivitas', function (Blueprint $table) {
            $table->id();
            $table->text('deskripsi');
            $table->timestamps();
            $table->foreignId('old_rekening', 20)->nullable();
            $table->foreignId('current_rekening', 20)->nullable();
            $table->foreignId('old_transaksi', 20)->nullable();
            $table->foreignId('current_transaksi', 20)->nullable();

            $table->foreign('old_rekening')->references('id')->on('old_rekenings')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('current_rekening')->references('id')->on('rekenings')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('old_transaksi')->references('id')->on('old_transaksi_inventaris')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('current_transaksi')->references('id')->on('transaksi_inventaris')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aktivitas');
    }
};
