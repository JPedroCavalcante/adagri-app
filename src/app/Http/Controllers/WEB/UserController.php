<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\User\DeleteUserService;
use App\Services\User\FindUserByIdService;
use App\Services\User\IndexUserService;
use App\Services\User\StoreUserService;
use App\Services\User\UpdateUserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class UserController extends Controller
{
    public function index(
        IndexUserRequest $indexUserRequest,
        IndexUserService $indexUserService,
    ): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $data = $indexUserRequest->validated();
        $users = $indexUserService->run($data);
        return view('users.index', compact('users'));
    }

    public function show(int $id, FindUserByIdService $findUserByIdService): Response
    {
        $user = $findUserByIdService->run($id);
        return response()->view('users.show', [
            'user' => $user,
        ]);
    }

    public function create(): Response
    {
        return response()->view('users.form');
    }

    public function edit(
        int                $id,
        FindUserByIdService $findUserByIdService
    ): Response
    {
        $user = $findUserByIdService->run($id);
        return response()->view('users.form', [
            'user' => $user,
        ]);
    }

    public function update(
        $id,
        UpdateUserRequest $updateUserRequest,
        UpdateUserService $updateUserService,
        findUserByIdService $findUserByIdService,
    ): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $user = $findUserByIdService->run($id);
        $data = $updateUserRequest->validated();
        $user = $updateUserService->run($data, $user);
        return view('users.form', ['user' => $user]);
    }

    public function destroy(
        int              $id,
        DeleteUserService $deleteUserService
    ): \Illuminate\Foundation\Application|Redirector|Application|RedirectResponse
    {
        $deleteUserService->run($id);
        return redirect('/users');
    }
}
