<?php

namespace App\Services\Job;

use App\Models\Job;

class DeleteJobService
{
    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    public function run(int $id)
    {
        $job = $this->job->where('id', $id)->firstOrfail();
        return $job->delete();
    }

}
