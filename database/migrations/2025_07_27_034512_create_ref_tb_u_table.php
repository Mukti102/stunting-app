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
        Schema::create('ref_tb_u', function (Blueprint $table) {
            $table->id();
            $table->enum('gender', ['laki-laki', 'perempuan']); 
            $table->integer('usia_bulan'); 
            $table->decimal('median', 5, 2);
            $table->decimal('sd', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_tb_u');
    }
};
