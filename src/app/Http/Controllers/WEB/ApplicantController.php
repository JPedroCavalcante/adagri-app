<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Services\Applicant\attachApplicantToJobService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function attachApplicantToJob(
        attachApplicantToJobService $attachApplicantToJobService,
        Applicant                   $applicant,
    ): Factory|\Illuminate\Foundation\Application|View|Application
    {

    }
}
