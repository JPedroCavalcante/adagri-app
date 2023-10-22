<?php

namespace App\Services\User;

use App\Models\Applicant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StoreUserService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function run(array $data): object
    {
        $data['password'] = isset($data['password']) ? Hash::make($data['password']) : Hash::make('password');

        $user = $this->user->create($data);

        if ($user->type == 'applicant') {
            Applicant::create([
                'user_id' => $user->id,
            ]);
        }
        return $user;
    }
}
