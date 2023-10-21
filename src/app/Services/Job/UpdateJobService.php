<?php

namespace App\Services\Job;

use app\Models\Job;

class UpdateJobService
{
    public function run(array $data, object $job): object
    {
        $job->update($data);
        return $job;
    }
}
