<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Requests\Job\IndexJobRequest;
use App\Http\Requests\Job\StoreJobRequest;
use App\Http\Requests\Job\UpdateJobRequest;
use app\Models\Job;
use App\Services\Job\DeleteJobService;
use App\Services\Job\IndexJobService;
use App\Services\Job\StoreJobService;
use App\Services\Job\UpdateJobService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
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

    public function store(
        StoreJobRequest $storeJobRequest,
        StoreJobService $storeJobService,
    ): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $data = $storeJobRequest->validated();
        $storeJobService->run($data);
        return redirect('/jobs');
    }

    public function update(
        UpdateJobRequest $updateJobRequest,
        UpdateJobService $updateJobService,
        Job              $job,
    ): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $data = $updateJobRequest->validated();
        $job = $updateJobService->run($data, $job);
        return view('jobs.edit', ['job' => $job]);
    }

    public function destroy(
        DeleteJobService $deleteJobService,
        int              $id,
    ): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $deleteJobService->run($id);
        return redirect('/jobs')->with('msg', 'Vaga excluída!');
    }
}
