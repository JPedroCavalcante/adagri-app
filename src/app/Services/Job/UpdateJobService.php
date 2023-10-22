<?php

namespace App\Services\Job;

class UpdateJobService
{
    public function run(array $data, object $job)
    {
        $data['active'] = $data['active'] == "1" ? true : false;
        $job->update($data);
        return $job;
    }
}
