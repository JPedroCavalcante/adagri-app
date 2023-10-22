<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Job\IndexJobRequest;
use App\Http\Requests\Job\StoreJobRequest;
use App\Http\Requests\Job\UpdateJobRequest;
use App\Http\Resources\ApplicantResource;
use App\Http\Resources\JobResource;
use App\Models\Job;
use App\Services\Applicant\attachApplicantToJobService;
use App\Services\Job\DeleteJobService;
use App\Services\Job\FindJobByIdService;
use App\Services\Job\IndexJobService;
use App\Services\Job\StoreJobService;
use App\Services\Job\UpdateJobService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class JobController extends Controller
{
    public function index(
        IndexJobRequest $indexJobRequest,
        IndexJobService $indexJobService,
    ): AnonymousResourceCollection
    {
        $data = $indexJobRequest->validated();
        $jobs = $indexJobService->run($data);
        return JobResource::collection($jobs);
    }

    public function store(
        StoreJobRequest $storeJobRequest,
        StoreJobService $storeJobService
    ): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
    {
        $data = $storeJobRequest->validated();
        $job = $storeJobService->run($data);
        return response(new JobResource($job));
    }

    public function update(
        UpdateJobRequest $updateJobRequest,
        UpdateJobService $updateJobService,
        Job              $job
    ): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
    {
        $data = $updateJobRequest->validated();
        $job = $updateJobService->run($data, $job);
        return response(new JobResource($job));
    }

    public function destroy(
        DeleteJobService $deleteJobService,
        Job              $job,
    ): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
    {
        $response = $deleteJobService->run($job->id);
        return response($response);
    }

    public function attachApplicantToJob(
        int                         $id,
        findJobByIdService          $findJobByIdService,
        attachApplicantToJobService $attachApplicantToJobService,
    ): ApplicantResource
    {
        $job = $findJobByIdService->run($id);
        $applicant = $attachApplicantToJobService->run($job->id);
        return new ApplicantResource($applicant);
    }

}
