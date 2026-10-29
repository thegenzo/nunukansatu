<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransparansiData extends Model
{
    use HasFactory;
    protected $fillable = [
        'transparansi_year_id',
        'title',
        'docs',
        'date_publish',
    ];
}
