<?php

namespace App\Helpers\Enum;

class AbdominalResistanceEnum
{
    const NAO_AVALIAR = 1;
    const REGULAR = 2;
    const BOM = 3;
    const OTIMA = 4;

    public static function getOptionsCombo()
    {
        return [
            self::NAO_AVALIAR => 'Não Avaliar',
            self::REGULAR => 'Regular',
            self::BOM => 'Bom',
            self::OTIMA => 'Ótima'
        ];
    }
}
