<?php

namespace App\Service;

use App\Exceptions\ApiException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Attachment;
use App\Models\User;
use App\Repository\AttachmentRepository;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @param LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $token = Auth::guard('api')->attempt($credentials);
        if (!$token) {
            throw ApiException::unauthorized('Email or password is incorrect.');
        }

        $user = Auth::guard('api')->user();

        return [
            'status' => 'Success',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer'
            ]
        ];
    }

    /**
     * @param RegisterRequest $request
     */
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!$user) {
            throw ApiException::badRequest('Sign up is failed.');
        }

        $token = Auth::login($user);

        return [
            'status' => 'Success',
            'message' => 'Sign up is successful',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer'
            ]
        ];
    }
}

