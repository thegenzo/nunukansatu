<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekStrategisDaerah extends Model
{
    use HasFactory;
    protected $fillable = [
        'proyek_strategis_daerah_year_id',
        'nama',
        'opd',
        'pagu',
        'metode',
        'rencana_pelaksanaan',
        'sumber_dana',
        'file',
    ];
}
