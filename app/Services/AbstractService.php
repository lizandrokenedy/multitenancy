<?php

namespace App\Services;

use App\Messages\Messages;
use Exception;

abstract class AbstractService
{

    public function validateRecordNotFound($registry)
    {
        if (!$registry) {
            throw new Exception(Messages::REGISTRO_NAO_ENCONTRADO);
        }
    }
}
