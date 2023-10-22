<?php

namespace App\Services\User;

class UpdateUserService
{
    public function run(array $data, object $user): object|bool
    {
        $user->update($data);
        return $user;
    }
}
