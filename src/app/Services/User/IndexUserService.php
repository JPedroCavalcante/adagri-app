<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class IndexUserService
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function run($data): Collection|LengthAwarePaginator
    {
        $search = $data['filters']['search'] ?? null;
        $email = $data['filters']['email'] ?? null;
        $type = $data['filters']['type'] ?? null;

        $query = $this->user
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', $search . '%');
            })
            ->when($email, function ($query) use ($email) {
                return $query->where('email', 'like', $email . '%');
            })
            ->when($type, function ($query) use ($type) {
                return $query->where('type', $type);
            });

        return $query->paginate(20)->withQueryString();
    }
}
