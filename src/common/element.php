<?php

abstract class Element extends Paint {
    public function __construct(
        public String $name,
        public String $id,
        public Array $styles,
        public Array $children,
    ) {
        
    }

    public function paint() : String {
        $result = PaintUtil::bufferPaint($this->children ?? []);

        return '<'.$this->name.' id="'.$this->id.'">'.$result.'</'.$this->name.'>';
    }
}
