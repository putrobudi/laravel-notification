<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    public function isBest() {
      return $this->id === $this->conversation->best_reply_id;
    }

    public function conversation() {
      return $this->belongsTo(Conversation::class); // select * from replies where conversation_id = 
    }

    public function user() {
      return $this->belongsTo(User::class);
    }
}

// $reply->conversation 
// this generates a conversation that belongs to the reply.
