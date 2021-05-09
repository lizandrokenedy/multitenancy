<?php

namespace App\Helpers;

class DataTable
{
    public static function getOrder(array $params): array
    {
        $column = $params['columns'][$params['order'][0]['column']]['name'];
        $order = $params['order'][0]['dir'];

        return [
            'column' => $column,
            'order' => $order
        ];
    }
}
