<?php

namespace App\Services\User;

use App\Models\User;

class DeleteUserService
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function run(int $id)
    {
        $user = $this->user->where('id', $id)->firstOrfail();
        if ($user->applicant) {
            $user->applicant->delete();
        }

        return $user->delete();
    }

}
