<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

class AuthenticationService
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Autentica um usuário e retorna um token de acesso
     *
     * @return Response
     */
    public function login()
    {
        $credentials = $this->request->only(['email', 'password']);
        $isAuthenticated = Auth::attempt($credentials);
        $user = Auth::user();

        return $isAuthenticated
            ? response()->json(['token' => $user->createToken('token')->plainTextToken])
            : response()->json(['message' => 'Unauthorized'], 401);
    }

    /**
     * Registra um usuário e retorna um token de acesso
     *
     * @return Response
     */
    public function register()
    {
        try {
            $user = User::create($this->request->all());
            $user->password = bcrypt($this->request->password);
            $user->save();
            return response()->json([
                'message' => 'cadastrado',
                'user' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'error' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Desloga um usuário
     *
     * @return Response
     */
    public function logout()
    {
        $this->request->user()->currentAccessToken()->delete();
        return response()->json(['msg' => 'Logout realizado com sucesso']);
    }
    public function update()
    {
        try {
            // pegando o usuario logado sem ser pela request
            $user = Auth::user();
            $user = User::find($user->id);
            $user->update($this->request->all());
            return response()->json([
                'msg' => 'Usuário atualizado com sucesso',
                'user' => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Erro ao atualizar usuário',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
