<?php

namespace App\Services;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteService
{
    private function attachUser(Cliente $cliente)
    {
        $cliente->users()->attach(auth()->user()->id);
    }

    private function updateCliente(Cliente $cliente, Request $request)
    {
        $cliente->nome = $request->nome;
        $cliente->email = $request->email;
        $cliente->imagem = $request->imagem;
        $cliente->save();
    }

    private function createResponse(string $message, $cliente)
    {
        return response()->json([
            'message' => $message,
            'cliente' => $cliente
        ]);
    }

    public function store(Request $request)
    {
        $cliente = Cliente::create($request->all());
        $this->attachUser($cliente);
        return $this->createResponse('cadastrado', $cliente);
    }

    public function update(Request $request)
    {
        $cliente = Cliente::find($request->id);
        $this->updateCliente($cliente, $request);
        return $this->createResponse('atualizado', $cliente);
    }

    public function destroy(Request $request)
    {
        $cliente = Cliente::find($request->id);
        $cliente->users()->detach(auth()->user()->id);
        $cliente->delete();
        return $this->createResponse('deletado', $cliente);
    }
}
