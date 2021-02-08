<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../styles.php';

class Container extends Widget {
    public function __construct(
        public String|Null $width = null,
        public String|Null $height = null,
        public String|Null $maxWidth = null,
        public String|Null $maxHeight = null,
        public String|Null $minWidth = null,
        public String|Null $minHeight = null,
        public BoxTheme|Null $normal = null,
        public BoxTheme|Null $hover= null,
        public BoxTheme|Null $press = null,
        public Widget|Null $child = null,
        public Edges|Null $margin = null,
    ) { }

    private function getContainerStyle() {
        return new StyleStrategy(
            name: CssTags::class("__container"),
            styles: [ 
                new StyleValue(CssTags::Width, Metrica::pr(100)),
                new StyleValue(CssTags::Height, Metrica::pr(100)),
                new StyleValue(CssTags::Display, CssTags::Block),
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

        if ($this->normal !== null) {
            $idStyle->styles = array_merge($idStyle->styles, $this->normal->createTheme());
        }

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

        if ($this->margin != null) {
            $idStyle->styles[] = $this->margin;
        }

        $styles[] = $idStyle;

        if ($this->hover !== null) {
            $styles[] = new StyleStrategy(
                name: CssTags::id($id),
                action: 'hover',
                styles: $this->hover->createTheme(),
            );
        }

        if ($this->press !== null) {
            $styles[] = new StyleStrategy(
                name: CssTags::id($id),
                action: 'active',
                styles: $this->press->createTheme(),
            );
        }

        return new Element(
            name: 'div',
            id: $id,
            classes: [ "__container" ],
            styles: $styles,
            children:  $this->child !== null 
                ? [ $this->child->createElement() ]
                : [ ],
        );
    }
}