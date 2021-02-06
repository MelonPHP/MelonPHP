<?php

require_once __DIR__ . '/../styles/padding_style.php';
require_once __DIR__ . '/../common/widget.php';

abstract class FontWeight {
    const Regular = "400";
    const Medium = "500";
    const Bold = "900";
}

class Text extends Widget {
    public function __construct(
        public String $text,
        public String $fontSize = "12px",
        public String $fontWeight = "400",
        public String $color = "#000",
    ) { }

    public function build() : Paint {
        return new Element(
            name: 'p',
            styles: [ 
                new Style('font-size', $this->fontSize),
                new Style('font-weight', $this->fontWeight),
                new Style('color', $this->color),
            ],
            child: $this->text,
        );
    }
}

