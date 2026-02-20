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
        Schema::create('detail_notas', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->integer('harga');
            $table->string('jumlah');
            $table->timestamps();

            $table->foreignId('nota_id')
            ->constrained('notas') 
            ->onDelete('cascade');

            $table->string('kd_barang');
            $table->foreign('kd_barang')
              ->references('kd_barang')
              ->on('barangs')
              ->onDelete('cascade')
              ->onUpdate('cascade');
        });

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_notas');
    }
};
