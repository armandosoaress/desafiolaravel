<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    private $loginRequest;

    public function __construct(LoginRequest $loginRequest)
    {
        $this->loginRequest = $loginRequest;
    }

    public function index(Request $request)
    {
        return $request->user();
    }

    public function login(Request $request)
    {
        return $this->loginRequest->login($request);
    }

    public function register(Request $request)
    {
        return $this->loginRequest->register($request);
    }

    public function logout(Request $request)
    {
        return $this->loginRequest->logout($request);
    }
    public function update(Request $request)
    {
        return $this->loginRequest->update($request);
    }
}
