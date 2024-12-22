<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Biodata extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'media_agreement',
        'running_tab',
        'birth_date',
        'skin_color',
        'height',
        'weight',
        'blood_group',
    ];
}
