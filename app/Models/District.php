<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'division_id',
        'district_id',
        'district_name',
        'district_bn_name',
        'district_lat',
        'district_long',
        'district_population',
    ];
}
