<?php

require_once __DIR__ . '/paint.php';
require_once __DIR__ . '/../utils.php';

class Element extends Paint {
    public function __construct(
        public String $name,
        public String|Null $id = null,
        public Array|Null $classes = null,
        public bool $isClose = false,
        public Array $tags = [],
        public Array $styles = [],
        public Array $children = [],
    ) {
        
    }

    public function paint() : String {
        $tags = [
            new ElementTag('id', $this->id),
            new ElementTag('class', $this->classes !== null
                ? PaintUtil::buffer($this->classes, separator: ' ')
                : null
            ),
        ];
        
        $tags = array_merge($tags, $this->tags);

        $tags = PaintUtil::arrayWhere($tags, function ($e) {
            return $e->value !== null;
        });

        $tagsDrawResult = PaintUtil::bufferPaint($tags, separator: ' ');
        $cildrenDrawResult = PaintUtil::bufferPaint($this->children);

        return !$this->isClose
            ? '<'.$this->name.$tagsDrawResult.'>'.$cildrenDrawResult.'</'.$this->name.'>'
            : '<'.$this->name.$tagsDrawResult.'/>';
    }
}
