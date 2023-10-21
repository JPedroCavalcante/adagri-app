<?php

namespace App\Services\Job;

use app\Models\Job;
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
        $search = $data['filters']['search'] ?? null;
        $salary = $data['filters']['salary'] ?? null;
        $type = $data['filters']['type'] ?? null;
        $paginate = isset($data['paginate']) && $data['paginate'];

        $query = $this->job
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', $search . '%');
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

        if ($paginate) {
            return $query->paginate(20)->withQueryString();
        }

        return $query->get();
    }
}
