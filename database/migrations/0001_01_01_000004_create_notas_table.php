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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->string('no_nota')->unique(); 
            $table->date('tanggal');
            $table->bigInteger('total_jumlah'); 
            $table->string('nama_penerima');
            $table->timestamps();
    
           
            $table->string('kd_apotek');
            $table->foreign('kd_apotek')
                  ->references('kd_apotek')
                  ->on('apoteks')
                  ->onDelete('cascade');
    
            
            $table->foreignId('id_user')
                  ->constrained('users', 'id') 
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
