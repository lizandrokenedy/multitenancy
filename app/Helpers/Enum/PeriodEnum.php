<?php

namespace App\Helpers\Enum;

class PeriodEnum
{
    const MATUTINO = 1;
    const VESPERTINO = 2;
    const NOTURNO = 3;

    public static function getOptionsCombo()
    {
        return [
            self::MATUTINO => 'Matutino',
            self::VESPERTINO => 'Vespertino',
            self::NOTURNO => 'Noturno',
        ];
    }
}
