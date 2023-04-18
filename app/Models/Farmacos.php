<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bibliografias;

class Farmacos extends Model
{
    use HasFactory;
    
    public function bibliografias()
    {
        return $this->belongsToMany(Bibliografias::class,'farmacobibliografia');
    }
    protected $fillable = [
        'id',
        'farmaco',
        'mecasnimo',
        'url',
        'efecto',
        'id_grupo'
    ];
    
}

