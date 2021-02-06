<?php

class PaintUtil {
    public static function buffer(Array $array, $function, String $separator = '') : String {
        $buffer = '';
        
        foreach ($array as $item) {
            $result = $function($item);

            if ($result !== null) {
                $buffer .= $separator.$result;
            }
        }

        return $buffer;
    }

    public static function bufferPaint(Array $array, String $separator = '') : String {
        return PaintUtil::buffer($array, function ($e) {
            return $e->paint();
        }, separator: $separator);
    }

    public static function arrayWhere(Array $array, $function) : Array {
        $buffer = [];

        foreach ($array as $value) {
            if ($function($value)) {
                $buffer[] = $value;
            }
        }

        return $buffer;
    }
}