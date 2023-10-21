<?php

namespace App\Services\Applicant;

class attachApplicantToJobService
{
    public function run(array $data, object $applicant): object
    {
        $applicant->jobs()->sync($data['jobs']);
        $applicant->load('jobs');
        return $applicant;
    }
}
