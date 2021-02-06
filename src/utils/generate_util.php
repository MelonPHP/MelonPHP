<?php

require_once __DIR__ . '/../melon.php';

class GenerateUtil {
    public static function randomString($length = null, $mask = null) {
        $characters = $mask ?? '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
      
        for ($i = 0; $i < $length ?? 32; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
      
        return $randomString;
    }
}