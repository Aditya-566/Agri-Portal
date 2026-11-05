<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Chat extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'chats';

    protected $fillable = [
        'participants', // Array of User IDs [buyer_id, farmer_id]
        'messages', // Array of arrays: [['sender_id', 'message', 'created_at']]
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    // Helper to get the other participant's User object
    public function otherParticipant($currentUserId)
    {
        $otherId = collect($this->participants)->first(fn($id) => $id !== $currentUserId);
        return User::find($otherId);
    }
}
