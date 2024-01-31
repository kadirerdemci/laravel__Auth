<?php

namespace App\Http\Controllers\Api;

use App\Core\HttpResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthController\LoginRequest;
use App\Http\Requests\AuthController\MeRequest;
use App\Http\Requests\AuthController\RegisterRequest;
use App\Interfaces\IUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponse;
    private IUserService $userService;
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $response = $this->userService->register(
            name: $request->name,
            email: $request->email,
            password: $request->password,
        );
        return $this->httpResponse(
            isSuccess: $response->isSuccess(),
            message: $response->getMessage(),
            data: $response->getData(),
            statusCode: $response->getStatusCode(),
        );
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $response = $this->userService->login(
            email: $request->email,
            password: $request->password
        );
        return $this->httpResponse(
            isSuccess: $response->isSuccess(),
            message: $response->getMessage(),
            data: $response->getData(),
            statusCode: $response->getStatusCode(),
        );
    }

    public function me(MeRequest $request): JsonResponse
    {
       return $this->httpResponse(
            isSuccess: true,
            message: 'User data retrieved successfully',
            data: $request->user(),
            statusCode: 200,
        );
    }


}
