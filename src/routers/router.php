<?php

class Route {
    private static Array $routes = [];
  
    public static function add(String $path, $function){
        self::$routes[$path] = $function;
    }

    public static function run(String $init, String $notFind = null) {
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);

        if(isset($parsed_url['path'])){
            $path = $parsed_url['path'];
        } else {
            $path = '/';
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
  
  }