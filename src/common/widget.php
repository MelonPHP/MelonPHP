<?php

require_once __DIR__ . '/element.php';

abstract class Widget {
    public abstract function createElement() : Element;
}