<?php

namespace App\Repositories\DB;

use Illuminate\Support\Facades\DB;

class InformationSchemaRepository
{

    public function databaseQueryByBame(string $database)
    {
        $result = DB::select('SELECT COUNT(*) AS total FROM information_schema.SCHEMATA WHERE SCHEMA_NAME LIKE :database', [
            'database' => $database,
        ]);

        return $result[0]->total;
    }
}
