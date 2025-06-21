<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = [
        'visitor_id', 'from_visitor', 'text', 'telegram_message_id',
    ];
}
