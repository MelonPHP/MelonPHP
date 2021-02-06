<?php

require_once __DIR__ . '/../common/paint.php';

class Style extends Paint {
    public function __construct(
        public String $name,
        public String $value,
    ) { }

    public function paint() : String|Null {
        return $this->name.': '.$this->value.';';
    }
}

function Px(int|float $value) : String {
    return $value.'px';
}

function Pr(int|float $value) : String {
    return $value.'%';
}

function Hex(String $value) : String {
    return '#'.$value;
}