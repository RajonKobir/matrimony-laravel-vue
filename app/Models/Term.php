<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Term extends Model
{
    use HasFactory;
    protected $fillable = [
        'serial_no',
        'question',
        'question_en',
        'answer',
        'answer_en',
        'in_trash',
        'in_admin_trash',
        'admin_comment',
    ];
}
