<?php

require_once __DIR__ . '/paint.php';
require_once __DIR__ . '/../utils.php';

class StyleStrategy extends Paint {
    public function __construct(
        public String $name,
        public String|Null $action = null,
        public Array $styles,
    ) {
        
    }

    public function paint() : String {
        $result = PaintUtil::buffer($this->styles, function ($e) {
            return ' '.$e->paint();
        });

        // :<value> or [empty_string]
        $action = $this->action !==null 
            ? ':'.$this->action 
            : '';

        return $this->name.$action.' {'.$result.' }';
    }
}