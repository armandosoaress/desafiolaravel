<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;


class ClienteController extends Controller
{
    private $clienteRequest;

    public function __construct(clienteRequest $clienteRequest)
    {
        $this->clienteRequest = $clienteRequest;
    }

    public function index()
    {
        // $clientes = Cliente::all();
        // return response()->json($clientes);

        // peganod meu id 
        $user_id  = auth()->user()->id;
        $clientes = Cliente::whereHas('users', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();
        
        return response()->json($clientes);
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);
        return response()->json($cliente);
    }

    public function store(Request $request)
    {
        
        return $this->clienteRequest->store($request);

    }

    public function update(Request $request)
    {
        return $this->clienteRequest->update($request);
       
    }

    public function destroy(Request $request)
    {
        return $this->clienteRequest->destroy($request);
    }
}
