<?php

namespace App\Models\relationships;

use App\Models\User;

trait AttachmentRelationship
{
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_attachments')->withTimestamps();
    }
}
