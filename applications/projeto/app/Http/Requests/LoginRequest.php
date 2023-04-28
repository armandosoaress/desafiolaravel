<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\AuthenticationService;

class LoginRequest extends FormRequest
{
    protected $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function login($request)
    {
        $max_size = 1024 * 1024; // 1 MB

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'max' => "O tamanho máximo da solicitação é de {$max_size} bytes",
        ], ['max' => $max_size]);

        return $this->authenticationService->login($request);
    }

    public function register($request)
    {
        $max_size = 1024 * 1024; // 1 MB

        $request->validate([
            'email' => 'required|email',
            'name' => 'required|min:6',
            'password' => 'required|min:6',
        ], [
            'max' => "O tamanho máximo da solicitação é de {$max_size} bytes",
        ], ['max' => $max_size]);

        return $this->authenticationService->register($request);
    }

    public function Logout($request)
    {
        return $this->authenticationService->Logout($request);
    }

    public function update($request)
    {
        $max_size = 1024 * 1024; // 1 MB

        $request->validate([
            'email' => 'required|email',
            'name' => 'required|min:6',
            'password' => 'required|min:6',
        ], [
            'max' => "O tamanho máximo da solicitação é de {$max_size} bytes",
        ], ['max' => $max_size]);

        return $this->authenticationService->update($request);
    }
}
