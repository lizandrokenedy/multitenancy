<?php

namespace App\Http\Controllers;

use App\Messages\Messages;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Gate;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseSuccess($msg = Messages::OPERACAO_REALIZADA_COM_SUCESSO, $status = 200)
    {
        return response()->json(['message' => $msg, 'success' => true], $status);
    }

    public function responseDataSuccess($data = [], $msg = Messages::OPERACAO_REALIZADA_COM_SUCESSO, $status = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $msg,
            'success' => true,
        ], $status);
    }

    public function responseError($msg = Messages::ERRO_AO_REALIZAR_OPERACAO, $status = 400)
    {
        return response()->json([
            'message' => $msg,
            'success' => false
        ], $status);
    }

    public function checkPermission($permissions)
    {
        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                if(!Gate::check($permission)) {
                    throw new Exception(Messages::ACESSO_NEGADO, 403);
                }
            }
        }

        if(!Gate::check($permissions)) {
            throw new Exception(Messages::ACESSO_NEGADO, 403);
        }
    }
}
