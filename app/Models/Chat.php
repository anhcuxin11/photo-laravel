<?php

namespace App\Models;

use App\Models\relationships\ChatRelationship;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use ChatRelationship;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'message',
    ];
}
