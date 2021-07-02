<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repository\Auth\AuthRepository;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    private $authRepository;

    public function __construct(AuthRepository $authRepository) {
        $this->authRepository = $authRepository;
        $this->middleware('throttle:5,5')->only('login');
    }

    public function register(Request $request)
    {
        $user = $this->authRepository->register($request);
        return $user;
    }

    public function login(Request $request)
    {
        $user = $this->authRepository->login($request);
        return $user;
    }
}
