<?php

namespace App\Services\Job;

class UpdateJobService
{
    public function run(array $data, object $job): object|bool
    {
        $data['active'] = $data['active'] == "1" ? true : false;
        $job->update($data);
        return $job;
    }
}
