<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_user_id',
        'sender_biodata_code',
        'receiver_user_id',
        'receiver_biodata_code',
        'like_deleted',
    ];
}
