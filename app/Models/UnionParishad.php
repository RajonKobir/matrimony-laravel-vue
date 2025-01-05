<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnionParishad extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'division_id',
        'district_id',
        'upazila',
        'union_parishad',
    ];
}
