<?php

namespace App\Models;

use App\Models\relationships\AttachmentRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use AttachmentRelationship;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'upload_file_name',
        'upload_file_path',
        'created_at',
        'updated_at'
    ];
}
