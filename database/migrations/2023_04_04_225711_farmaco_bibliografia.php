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
        Schema::create('farmacobibliografia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bibliografias_id')->nullable();
            $table->foreign('bibliografias_id')->references('id')->on('bibliografias')->onUpdate('cascade')->onDelete('set null');
            $table->unsignedBigInteger('farmacos_id');
            $table->foreign('farmacos_id')->references('id')->on('farmacos')->onUpdate('cascade')->onDelete('cascade');
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
