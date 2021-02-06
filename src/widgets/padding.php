<?php

require_once __DIR__ . '/../styles/padding_style.php';
require_once __DIR__ . '/../common/widget.php';

class Padding extends Widget {
    public function __construct(
        public PaddingValue $padding,
        public Element $child,
    ) { }

    public function createElement() : Element {
        $id = GenerateUtil::randomString();

        return new Element(
            name: 'div',
            id: $id,
            styles: [
                new StyleStrategy(
                    name: '#'.$id,
                    styles: [ $this->padding ],
                ),
            ],
            children: [ $this->child ] ,
        );
    }
}