<?php

namespace App\Repository;

use App\Models\Attachment;

class AttachmentRepository
{
    /**
     * Store user attachment
     *
     * @param array $data
     *
     * @return UserAttachment
     */
    public function store(array $data)
    {
        return Attachment::create($data);
    }

    /**
     * Get attachment by id
     *
     * @param int $id
     *
     * @return Attachment|null
     */
    public function getById(int $id)
    {
        return Attachment::find($id);
    }

    /**
     *
     */
    public function getAll(int $userId)
    {
        return Attachment::query()
                    ->whereHas('users', function($q) use ($userId) {
                        $q->where('users.id', $userId);
                    })
                    ->get();
    }
}
