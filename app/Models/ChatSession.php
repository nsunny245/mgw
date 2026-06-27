<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    protected $fillable = [
        'visitor_name',
        'visitor_email',
        'status',
        'assigned_to',
    ];

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
