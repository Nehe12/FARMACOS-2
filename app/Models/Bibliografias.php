<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Farmacos;

class Bibliografias extends Model
{
    use HasFactory;
    public function farmacos()
    {
        return $this->belongsToMany(Farmacos::class, 'farmacobibliografia');
    }
     protected $fillable = [
        'id',
        'titulo',
        'descripcion',
        'autor',
        'anio',
        'editorial'
    ];
}
