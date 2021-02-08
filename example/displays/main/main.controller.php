<?php

require_once __DIR__ . '/../../../src/melon.php';

class MainDisplayController extends Controller {
    public String|Null $name;

    function __construct() {
        $this->name = $this->getValue('name');
    }
}