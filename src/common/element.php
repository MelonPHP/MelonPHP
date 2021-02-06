<?php

abstract class Element extends Paint {
    public function __construct(
        public String $name,
        public String $id,
        public Array $styles,
        public Array $children,
    ) {
        
    }

    public function paintContent() : String {
        if ($this->children !== null) {
            return PaintUtil::bufferPaint($this->children);
        }

        return '';
    }

    public function paint() : String {
        return '<'.$this->name.' id="'.$this->id.'">'.$this->paintContent().'</'.$this->name.'>';
    }
}
