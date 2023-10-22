<?php

namespace App\Services\User;

use App\Models\User;

class FindUserByIdService
{
    public function run(int $id)
    {
        return User::findOrFail($id);
    }
}
