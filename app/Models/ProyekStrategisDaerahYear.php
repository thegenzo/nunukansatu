<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekStrategisDaerahYear extends Model
{
    use HasFactory;
    protected $fillable = [
        'year', 'file'
    ];
}
