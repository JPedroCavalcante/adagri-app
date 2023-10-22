<?php

namespace App\Services\Applicant;

use App\Models\Applicant;
use Illuminate\Support\Facades\Auth;

class attachApplicantToJobService
{
    public function run(int $jobId): object
    {
        $applicant = Auth::user()->applicant;
        $applicant->jobs()->sync($jobId);
        $applicant->load('jobs');
        return $applicant;
    }
}
