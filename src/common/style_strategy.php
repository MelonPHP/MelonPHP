<?php

class StyleStrategy extends Paint {
    public function __construct(
        public String $name,
        public Array $action,
        public Array $styles,
    ) {
        
    }

    public function paint() : String {
        $result = PaintUtil::bufferPaint($this->styles);

        return $this->name.':'.$this->action.' {'.$result.'}';
    }
}