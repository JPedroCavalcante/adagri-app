<?php

namespace App\Services\Job;

use App\Models\Job;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class IndexJobService
{
    private Job $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    public function run($data): Collection|LengthAwarePaginator
    {
        $name = $data['filters']['name'] ?? null;
        $salary = $data['filters']['salary'] ?? null;
        $type = $data['filters']['type'] ?? null;

        $query = $this->job
            ->when($name, function ($query) use ($name) {
                return $query->where('name', 'like', $name . '%');
            })
            ->when($salary, function ($query) use ($salary) {
                return $query->where('salary', 'like', $salary . '%');
            })
            ->when($type, function ($query) use ($type) {
                return $query->where('type', $type);
            })
            ->when(isset($data['filters']['active']), function ($query) use ($data) {
                return $query->where('active', $data['filters']['active']);
            });

        return $query->paginate(20)->withQueryString();
    }
}
