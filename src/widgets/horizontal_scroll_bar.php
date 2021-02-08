<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../styles.php';

class HorizontalScrollBar extends Widget {
    public function __construct(
        public String|Null $width = null,
        public String|Null $height = null,
        public String|Null $maxWidth = null,
        public String|Null $maxHeight = null,
        public String|Null $minWidth = null,
        public String|Null $minHeight = null,
        public Widget|Null $child = null,
    ) { }

    private function getContainerStyle() {
        return new StyleStrategy(
            name: CssTags::class("__horizontal_scroll_bar"),
            styles: [ 
                new StyleValue(CssTags::Width, Metrica::pr(100)),
                new StyleValue(CssTags::Height, Metrica::pr(100)),
                new StyleValue(CssTags::OverflowX, CssTags::Auto),
                new StyleValue(CssTags::OverflowY, CssTags::Hidden),
            ],
        );
    }

    public function createElement() : Element {
        $id = GenerateUtil::randomString();

        $styles = [];

        $styles[] = $this->getContainerStyle();

        $idStyle = new StyleStrategy(
            name: CssTags::id($id),
            styles: [],
        );
        
        if ($this->width !== null) {
            $idStyle->styles[] = new StyleValue(CssTags::Width, $this->width);
        }

        if ($this->height !== null) {
            $idStyle->styles[] = new StyleValue(CssTags::Height, $this->height);
        }

        if ($this->maxWidth !== null) {
            $idStyle->styles[] = new StyleValue(CssTags::MaxWidth, $this->maxWidth);
        }

        if ($this->maxHeight !== null) {
            $idStyle->styles[] = new StyleValue(CssTags::MaxHeight, $this->maxHeight);
        }

        if ($this->minWidth !== null) {
            $idStyle->styles[] = new StyleValue(CssTags::MinWidth, $this->minWidth);
        }

        if ($this->minHeight !== null) {
            $idStyle->styles[] = new StyleValue(CssTags::MinHeight, $this->minHeight);
        }

        $styles[] = $idStyle;

        return new Element(
            name: 'div',
            id: $id,
            classes: [ "__horizontal_scroll_bar" ],
            styles: $styles,
            children:  $this->child !== null 
                ? [ $this->child->createElement() ]
                : [ ],
        );
    }
}