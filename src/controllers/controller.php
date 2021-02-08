<?php

class Controller {
    public function getValue(String $name) : String|Null {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        }
        else if (isset($_POST[$name])) {
            return $_POST[$name];
        }
        else return null;
    }
}