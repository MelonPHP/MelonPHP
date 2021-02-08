<?php

class Route {
    private static Array $routes = [];
  
    public static function add(String $path, $function) : void {
        self::$routes[$path] = $function;
    }

    public static function run(String $init = "/", String $notFind = null) : void {
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);

        if(isset($parsed_url['path'])){
            $path = $parsed_url['path'];
        } else {
            $path = $init;
        }

        foreach (self::$routes as $key => $value) {
            if ($key == $path) {
                $value()->display();
                return;
            }
        }

        if ($notFind !== null) {
            self::$routes[$notFind]()->display();
        }
    }

    public static function move(String $path = "/") {
        header('Location:'.$path);
        self::rip();
    }

    public static function rip() : void {
        die();
    }
  
}