<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'division_id',
        'division_name',
        'division_bn_name',
        'division_lat',
        'division_long',
        'division_population',
    ];
}
