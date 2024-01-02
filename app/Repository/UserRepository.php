<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    /**
     * Get user by id
     *
     * @param int $id
     *
     * @return User|null
     */
    public function getById(int $id)
    {
        return User::find($id);
    }
}
