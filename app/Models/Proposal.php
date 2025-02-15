<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proposal extends Model
{
    use HasFactory;
    protected $fillable = [
        'sender_user_id',
        'sender_biodata_code',
        'receiver_user_id',
        'receiver_biodata_code',
        'proposal_accepted',
        'proposal_sent_datetime',
        'proposal_accepted_datetime',
        'proposal_deleted',
        'auto_received',
        'auto_received_datetime',
    ];
}
