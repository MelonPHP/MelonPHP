<?php

class Metrica {
    public static function px(int|float $value) : String {
        return $value.'px';
    }
    
    public static function pr(int|float $value) : String {
        return $value.'%';
    }
}