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
        Schema::create('farmacos', function (Blueprint $table) {
            $table->id();
            $table->string('farmaco');
            $table->text('mecanismo');
            $table->text('public_id');
            $table->text('url');
            $table->text('efecto');
            
            $table->unsignedBigInteger('id_grupo')->nullable();
            $table->foreign('id_grupo')->references('id')->on('grupo_farmacos')->onUpdate('cascade')->onDelete('set null');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmacos');
    }
};
