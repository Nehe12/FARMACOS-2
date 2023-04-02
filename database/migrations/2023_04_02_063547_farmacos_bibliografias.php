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
        Schema::create('farmacos_bibliografias',function(Blueprint $table){
            $table ->id();
            $table->unsignedBigInteger('id_farmaco');
            $table->foreign('id_farmaco')->references('id')->on('farmacos')->onDelete('cascade');
            $table->unsignedBigInteger('id_bibliografia');
            $table->foreign('id_bibliografia')->references('id')->on('bibliografias')->onDelete('cascade');
            $table ->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmacos_bibliografias');
    }
};
