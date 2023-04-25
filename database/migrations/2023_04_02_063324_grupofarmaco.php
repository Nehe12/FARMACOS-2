<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grupo_farmacos',function(Blueprint $table){
            $table ->id();
            $table ->string('grupo');
            $table ->text('subgrupo');
            $table ->integer('estatus')->default(1);
            $table ->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo_farmacos');
    }
};
