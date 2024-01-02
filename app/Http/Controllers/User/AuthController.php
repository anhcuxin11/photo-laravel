<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Service\AuthService;
use App\Transformers\LoginResource;
use App\Transformers\SuccessResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    protected $authService;

    /**
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     *
     */
    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request);

        return LoginResource::make($result);
    }

    /**
     * @param RegisterRequest $request
     */
    public function register(RegisterRequest $request)
    {
        $result = $this->authService->register($request);

        return SuccessResource::make($result);
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();

        return SuccessResource::make();
    }
}
