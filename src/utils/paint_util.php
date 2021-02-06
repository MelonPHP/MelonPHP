<?php

require_once __DIR__ . '/../ui/common/paint.php';

class PaintUtil {
    public static function buffer(Array $array, $function) : String {
        $buffer = '';
        
        foreach ($array as $item) {
            $result = $function($item);

            if ($result !== null) {
                $buffer .= $result;
            }
        }

        return $buffer;
    }

    public static function bufferPaint(Array $array) : String {
        return PaintUtil::buffer($array, function ($e) {
            return $e->paint();
        });
    }
}