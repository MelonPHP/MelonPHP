<?php

require_once __DIR__ . '/../melon.php';

abstract class Widget {
    public abstract function createElement() : Element;
}