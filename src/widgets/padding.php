<?php

require_once __DIR__ . '/../styles/padding_style.php';
require_once __DIR__ . '/../common/widget.php';

class Padding extends Widget {
    public function __construct(
        public PaddingStyle $padding,
        public Paint $child,
    ) { }

    public function build() : Paint {
        return new Element(
            name: 'div',
            styles: [ $this->padding ],
            child: $this->child,
        );
    }
}