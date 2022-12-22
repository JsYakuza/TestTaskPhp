<?php

namespace Test\Logger\Helpers;

class Helpers 
{
    public static function interpolate($message, array $context = []) {
        $replace = [];
        foreach ($context as $key => $val) {
            $replace['{' . $key . '}'] = $val;
        }
        
        return strtr($message, $replace);
    }
}
