<?php
namespace App\Repository\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthRepository {

    public function register($request)
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

        return response(['message' => 'User successfully registered'], 201);
    }

    public function login($request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid credentials'], 401);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['access_token' => $accessToken], 201);
    }
}