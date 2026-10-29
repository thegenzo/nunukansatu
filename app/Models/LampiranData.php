<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LampiranData extends Model
{
    use HasFactory;
    protected $fillable = [
        'transparansi_data_id',
        'title',
        'file',
    ];

    public function transparansiData(){
        return $this->belongsTo(TransparansiData::class, 'transparansi_data_id');
    }
}
