<?php

namespace App\Services\Job;

class UpdateJobService
{
    public function run(array $data, object $job)
    {
        $job->update($data);
        return $job;
    }
}
