<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\Auth\LoginService;
use App\Services\Auth\LogoutService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $loginRequest, LoginService $loginService): Response|Application|ResponseFactory
    {
        $data = $loginRequest->validated();
        $response = $loginService->run($data);
        return response($response);
    }

    public function logout(LogoutService $logoutService): Response|Application|ResponseFactory
    {
        $response = $logoutService->run();
        return response($response);
    }

    public function user(): Response|Application|ResponseFactory
    {
        return response([
            'user' => new UserResource(auth()->user())
        ]);
    }
}
