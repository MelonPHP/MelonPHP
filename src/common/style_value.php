<?php

class StyleValue extends Paint {
    public function __construct(
        public String $name,
        public String $value,
    ) { }

    public function paint() : String {
        return $this->name.': '.$this->value.';';
    }
}