<?php
namespace App\Repository\Auth;

interface AuthInterface {
    public function register($request);
    public function login($request);
}