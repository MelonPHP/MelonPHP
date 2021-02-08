<?php

class PaintUtil {
    public static function buffer(Array $array, $function = null, String $separator = '') : String {
        $buffer = '';
        
        foreach ($array as $item) {
            $result = $function !== null 
                ? $function($item)
                : $item;

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

    public static function pushIfNotNull(Array &$array, $value, $modern = null) {
        if ($value !== null) {
            if ($modern !== null) {
                $array[] = $modern();
            }
            else {
                $array[] = $value;
            }
        }
    }
}