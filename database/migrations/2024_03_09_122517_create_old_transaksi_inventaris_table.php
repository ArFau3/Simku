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
        Schema::create('old_transaksi_inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('debit');
            $table->string('kredit');
            $table->string('jenis');
            $table->date('tanggal');
            $table->string('keterangan');
            $table->decimal('nominal', 16, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('old_transaksi_inventaris');
    }
};
