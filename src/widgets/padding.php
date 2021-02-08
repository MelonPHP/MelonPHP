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
                    styles: [ 
                        $this->padding,
                        new StyleValue(CssTags::Position, CssTags::Absolute),
                        new StyleValue(CssTags::Top, 0),
                        new StyleValue(CssTags::Left, 0),
                        new StyleValue(CssTags::Right, 0),
                        new StyleValue(CssTags::Bottom, 0),
                        new StyleValue(CssTags::Height, CssTags::Auto),
                    ],
                ),
            ],
            children: [ $this->child->createElement() ] ,
        );
    }
}