<?php

namespace App\Helpers;

class RegimeApuracaoHelper {

    public static $regimes = [
        'M' => 'Mensal',
        'T' => 'Trimestral',
        'S' => 'Semestral',
    ];

    public static function get($valor){
        return self::$regimes[$valor];
    }
}