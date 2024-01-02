<?php

namespace App\Models\relationships;

use App\Models\Attachment;
use App\Models\Chat;
use App\Models\Message;

trait UserRelationship
{
    public function attachments()
    {
        return $this->belongsToMany(Attachment::class, 'user_attachments')->withTimestamps();
    }

    public function chats()
    {
        return $this->hasMany(Chat::class,'user_id');
    }
}
