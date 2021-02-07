<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../utils.php';

class Padding extends Widget {
    public function __construct(
        public PaddingEdges $padding,
        public Widget $child,
    ) { }

    public function createElement() : Element {
        $id = GenerateUtil::randomString();

        return new Element(
            name: 'div',
            id: $id,
            styles: [
                new StyleStrategy(
                    name: Mea::id($id),
                    styles: [ $this->padding ],
                ),
            ],
            children: [ $this->child->createElement() ] ,
        );
    }
}