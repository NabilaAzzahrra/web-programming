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
        Schema::create('konsinyasi_pro', function (Blueprint $table) {
            $table->id();
            $table->integer('id_konsinyasi');
            $table->integer('id_produk');
            $table->integer('stok');
            $table->date('tgl_konsinyasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsinyasi_pro');
    }
};
