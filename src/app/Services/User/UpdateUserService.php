<?php

namespace App\Services\User;

use App\Models\Applicant;

class UpdateUserService
{
    public function run(array $data, object $user): object|bool
    {
        if ($user->type == 'applicant' && $data['type'] != 'applicant') {
            $user->applicant->delete();
        }

        if ($user->type != 'applicant' && $data['type'] == 'applicant') {
            Applicant::create([
                'user_id' => $user->id,
            ]);
        }

        $user->update($data);
        return $user;
    }
}
