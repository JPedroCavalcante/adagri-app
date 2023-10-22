<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\User\DeleteUserService;
use App\Services\User\IndexUserService;
use App\Services\User\StoreUserService;
use App\Services\User\UpdateUserService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function index(
        IndexUserRequest $indexUserRequest,
        IndexUserService $indexUserService,
    ): AnonymousResourceCollection
    {
        $data = $indexUserRequest->validated();
        $users = $indexUserService->run($data);
        return UserResource::collection($users);
    }

    public function store(
        StoreUserRequest $storeUserRequest,
        StoreUserService $storeUserService,
    ): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
    {
        $data = $storeUserRequest->validated();
        $user = $storeUserService->run($data);
        return response(new UserResource($user));
    }

    public function update(
        UpdateUserRequest $updateUserRequest,
        UpdateUserService $updateUserService,
        User              $user
    ): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
    {
        $data = $updateUserRequest->validated();
        $user = $updateUserService->run($data, $user);
        return response(new UserResource($user));
    }

    public function destroy(
        DeleteUserService $deleteUserService,
        User              $user,
    ): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
    {
        $response = $deleteUserService->run($user->id);
        return response($response);
    }
}
