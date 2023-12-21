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
        Schema::create('petanis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('varietas_sawit_id');
            $table->foreignId('pupuk_id');
            $table->foreignId('tahun_sawit_id');
            $table->string("nama", 100);
            $table->string("alamat", 150);
            $table->string("no_hp", 20);
            $table->float("luas_lahan", 10);
            $table->timestamps();

            $table->foreign('varietas_sawit_id')->references('id')->on('varietas_sawits')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('tahun_sawit_id')->references('id')->on('tahun_sawits')
                ->onUpdate('cascade')->onDelete('cascade');
            
            $table->foreign('pupuk_id')->references('id')->on('pupuks')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petanis');
    }
};
