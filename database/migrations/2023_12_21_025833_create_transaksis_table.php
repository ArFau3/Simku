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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('debit');
            $table->foreignId('kredit');
            $table->dateTime('tanggal');
            $table->string('keterangan');
            $table->decimal('nominal', 10, 2);
            $table->timestamps();

            $table->foreign('debit')->references('id')->on('rekenings')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('kredit')->references('id')->on('rekenings')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
