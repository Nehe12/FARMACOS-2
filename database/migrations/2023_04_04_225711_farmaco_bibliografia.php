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
        Schema::create('farmaco_bibliografia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('farmacos_id');
            $table->foreign('farmacos_id')->references('id')->on('farmacos')->onDelete('cascade');
            $table->unsignedBigInteger('bibliografias_id');
            $table->foreign('bibliografias_id')->references('id')->on('bibliografias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmaco_bibliografia');
    }
};
