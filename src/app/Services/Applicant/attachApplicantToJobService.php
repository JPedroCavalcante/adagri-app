<?php

namespace App\Services\Applicant;

use App\Exceptions\WrongLoginException;
use Illuminate\Support\Facades\Auth;

class attachApplicantToJobService
{
    public function run(int $jobId): object
    {
        $applicant = Auth::user()->applicant;
        if (!$applicant) {
            throw new WrongLoginException();
        }
        $applicant->jobs()->sync($jobId);
        $applicant->load('jobs');
        return $applicant;
    }
}
