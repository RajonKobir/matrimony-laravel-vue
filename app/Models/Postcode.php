<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Postcode extends Model
{
    use HasFactory;

    protected $fillable = [
        'division_id',
        'district_id',
        'upazila_name',
        'post_office_name',
        'post_code',
    ];
}
