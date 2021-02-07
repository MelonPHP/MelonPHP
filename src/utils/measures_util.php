<?php

class Mea {
    public static function px(int|float $value) : String {
        return $value.'px';
    }
    
    public static function pr(int|float $value) : String {
        return $value.'%';
    }
    
    public static function hex(String $value) : String {
        return '#'.$value;
    }

    public static function id(String $value) : String {
        return '#'.$value;
    }

    public static function class(String $value) : String {
        return '.'.$value;
    }

    public static function safari(string $value) : string {
        return "-webkit-".$value;
    }
    
    public static function mozilla(string $value) : string {
        return "-moz-".$value;
    }
}