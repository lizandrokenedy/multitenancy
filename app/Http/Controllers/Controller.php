<?php

namespace App\Http\Controllers;

use App\Messages\Messages;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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
            "draw" => count($data),
            "recordsTotal" => count($data),
            "recordsFiltered" => count($data),
            'data' => $data,
            'message' => $msg,
            'success' => true,
        ], $status);
    }

    public function responseError($msg = Messages::ERRO_AO_REALIZAR_OPERACAO, $status = 400)
    {
        return response()->json(['message' => $msg, 'success' => false], $status);
    }
}
