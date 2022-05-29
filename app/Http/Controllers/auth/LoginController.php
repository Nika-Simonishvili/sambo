<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

use function response;

class LoginController extends Controller
{
    public function username()
    {
        return 'username';
    }
    
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return response([
                'errors' => [
                    'password' => 'password or email is incorrect'
                ],
            ], 422);
        }

        $token = Auth::user()->createToken('accesstoken')->plainTextToken;

        return response([
            'message' => 'OK',
            'user' => new UserResource(Auth::user()),
            'token' => $token,
        ]);
    }
}
