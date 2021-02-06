<?php

require_once __DIR__ . '/../melon.php';

abstract class StyleTheme {
    public abstract function createTheme() : Array;
}