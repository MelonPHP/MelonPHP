<?php

class Mea {
    public static function Px(int|float $value) : String {
        return $value.'px';
    }
    
    public static function Pr(int|float $value) : String {
        return $value.'%';
    }
    
    public static function Hex(String $value) : String {
        return '#'.$value;
    }

    public static function Id(String $value) : String {
        return '#'.$value;
    }

    public static function Class(String $value) : String {
        return '.'.$value;
    }
}