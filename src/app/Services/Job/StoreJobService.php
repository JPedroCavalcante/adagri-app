<?php

namespace App\Services\Job;

use App\Models\Job;

class StoreJobService
{
    private Job $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    public function run(array $data): object
    {
        return $this->job->create($data);
    }
}
