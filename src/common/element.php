<?php

require_once __DIR__ . '/../melon.php';

abstract class Element extends Paint {
    public function __construct(
        public String $name,
        public String|Null $id = null,
        public Array $styles = [],
        public Array $children = [],
    ) {
        
    }

    public function paint() : String {
        $result = PaintUtil::bufferPaint($this->children ?? []);
        
        $id = $this->id !== null 
            ? ' id="'.$this->id 
            : '';

        return '<'.$this->name.$id.'">'.$result.'</'.$this->name.'>';
    }
}
