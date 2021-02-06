<?php

require_once __DIR__ . '/../melon.php';

class StyleValue extends Paint {
    public function __construct(
        public String $name,
        public String $value,
    ) { }

    public function paint() : String {
        return $this->name.': '.$this->value.';';
    }
}