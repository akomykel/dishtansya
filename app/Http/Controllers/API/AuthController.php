<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => 'email|required|unique:users'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Email already taken'], 400);    
        }

        $validatedPassword = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedPassword['password'] = Hash::make($request->password);
        $user = User::create($validatedPassword);
        $accessToken = $user->createToken('authToken')->accessToken;

        //return response(['user' => $user, 'access_token' => $accessToken], 201);
        return response(['message' => 'User successfully registered'], 201);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid credentials'], 401);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        //return response(['user' => auth()->user(), 'access_token' => $accessToken]);
        return response(['access_token' => $accessToken], 201);
    }
}
