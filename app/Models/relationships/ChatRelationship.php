<?php

namespace App\Models\relationships;

use App\Models\User;

trait ChatRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
