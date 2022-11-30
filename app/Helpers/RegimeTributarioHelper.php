<?php

namespace App\Helpers;

class RegimeTributarioHelper {
    
    public static $regimes = [
        'S' => 'Simples Nacional',
        'P' => 'Presumido',
        'R' => 'Real',
    ];

    public static function get($valor){
        return self::$regimes[$valor];
    }
}