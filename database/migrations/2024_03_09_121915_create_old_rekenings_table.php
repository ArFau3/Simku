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
        Schema::create('old_rekenings', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('nomor', 20);
            $table->integer("desimal");
            $table->string('rekening_induk', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('old_rekenings');
    }
};
