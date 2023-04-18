<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmaco_Bibliografia extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'bibliografias_id',
        'farmacos_id',
        
    ];
}
