<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

use function response;

class AuthController extends Controller
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
                    'password' => 'პაროლი არასწორია.'
                ],
            ], 422);
        }

        $token = Auth::user()->createToken('accesstoken')->plainTextToken;

        return response([
            'id' => Auth::id(),
            'message' => 'OK',
            'user' => new UserResource(Auth::user()),
            'token' => $token,
        ]);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response([
            'message' => 'Logged  out.'
        ]);
    }
}
