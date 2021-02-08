<?php

require_once __DIR__ . '/paint.php';

class StyleValue extends Paint {
    public function __construct(
        public String $name,
        public String|Null $value,
    ) { }

    public function paint() : String {
        assert($this->value !== null);
        return $this->name.': '.$this->value.';';
    }
}