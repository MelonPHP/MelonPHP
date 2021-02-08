<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../styles.php';

class Padding extends Widget {
    public function __construct(
        public Edges $padding,
        public Widget $child,
    ) { }

    public function createElement() : Element {
        $id = GenerateUtil::randomString();

        return new Element(
            name: 'div',
            id: $id,
            styles: [
                new StyleStrategy(
                    name: CssTags::id($id),
                    styles: [ $this->padding ],
                ),
            ],
            children: [ $this->child->createElement() ] ,
        );
    }
}