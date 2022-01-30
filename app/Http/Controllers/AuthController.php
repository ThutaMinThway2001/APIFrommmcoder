<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(AuthorRequest $request)
    {
        $attributes = $request->validated();
        $attributes['password'] = bcrypt(request('password'));
        $user = User::create($attributes);
        auth()->guard('web')->login($user);
        $token = $user->createToken('social')->accessToken;
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $user,
            'token' => $token
        ]);
    }

    public function login()
    {
        // $attributes = $request->validated();
        $attributes = request()->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (auth()->guard('web')->attempt($attributes)) {
            session()->regenerate();
            $user = auth()->user();
            $token = $user->createToken('social')->accessToken;
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $user,
                'token' => $token
            ]);
        }
        return response()->json([
            'status' => 500,
            'message' => 'fail',
            'data' => [
                'error' => 'email and password dont match'
            ],
        ]);
    }
}
