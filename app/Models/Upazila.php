<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Upazila extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_id',
        'upazila_id',
        'upazila_name',
        'upazila_bn_name',
        'upazila_population',
    ];
}
