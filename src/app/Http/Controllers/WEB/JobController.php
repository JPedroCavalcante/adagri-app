<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Requests\Job\IndexJobRequest;
use App\Http\Requests\Job\StoreJobRequest;
use App\Http\Requests\Job\UpdateJobRequest;
use App\Models\Job;
use App\Services\Applicant\attachApplicantToJobService;
use App\Services\Job\DeleteJobService;
use App\Services\Job\IndexJobService;
use App\Services\Job\FindJobByIdService;
use App\Services\Job\StoreJobService;
use App\Services\Job\UpdateJobService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class JobController extends Controller
{
    public function index(
        IndexJobRequest $indexJobRequest,
        IndexJobService $indexJobService,
    ): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $data = $indexJobRequest->validated();
        $jobs = $indexJobService->run($data);
        return view('jobs.index', compact('jobs'));
    }

    public function show(int $id, FindJobByIdService $findJobByIdService)
    {
        $job = $findJobByIdService->run($id);
        return response()->view('jobs.show', [
            'job' => $job,
        ]);
    }

    public function create(): Response
    {
        return response()->view('jobs.form');
    }

    public function store(
        StoreJobRequest $storeJobRequest,
        StoreJobService $storeJobService,
    ): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $data = $storeJobRequest->validated();
        $storeJobService->run($data);
        return redirect('/jobs');
    }

    public function edit(
        int                $id,
        FindJobByIdService $findJobByIdService
    ): Response
    {
        $job = $findJobByIdService->run($id);
        return response()->view('jobs.form', [
            'job' => $job,
        ]);
    }

    public function update(
        $id,
        UpdateJobRequest $updateJobRequest,
        UpdateJobService $updateJobService,
        findJobByIdService $findJobByIdService,
    ): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $job = $findJobByIdService->run($id);
        $data = $updateJobRequest->validated();
        $job = $updateJobService->run($data, $job);
        return view('jobs.form', ['job' => $job]);
    }

    public function destroy(
        int              $id,
        DeleteJobService $deleteJobService
    ): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $deleteJobService->run($id);
        return redirect('/jobs');
    }

    public function attachApplicantToJob(
        int                         $id,
        findJobByIdService          $findJobByIdService,
        attachApplicantToJobService $attachApplicantToJobService,
    )
    {
        $job = $findJobByIdService->run($id);
        $attachApplicantToJobService->run($job->id);
        return response()->view('jobs.show', [
            'job' => $job,
        ]);
    }
}
