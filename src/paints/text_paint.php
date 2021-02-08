<?php

require_once __DIR__ . '/../common.php';

class TextPaint extends Paint {
    public function __construct(
        public String $text,
    ) { }

    public function paint() : String {
        return $this->text;
    }
}