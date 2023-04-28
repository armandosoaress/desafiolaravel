<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\ClienteService;

class ClienteRequest extends FormRequest
{
    protected function getServiceInstance()
    {
        return new ClienteService();
    }

    private function validateRequest()
    {
        $max_size = 1024 * 1024; // 1 MB
        $this->validate([
            'email' => 'required|email',
        ], [
            'max' => "O tamanho máximo da solicitação é de {$max_size} bytes",
        ], ['max' => $max_size]);
    }

    public function store($request)
    {
        $this->validateRequest();
        $clienteService = $this->getServiceInstance();
        return $clienteService->store($request);
    }

    public function update($request)
    {
        $this->validateRequest();
        $clienteService = $this->getServiceInstance();
        return $clienteService->update($request);
    }

    public function destroy($request)
    {
        $clienteService = $this->getServiceInstance();
        return $clienteService->destroy($request);
    }
}
