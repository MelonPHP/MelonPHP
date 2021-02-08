<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../styles.php';

class Image extends Widget {
    public function __construct(
        public String $path,
        public String|Null $width = null,
        public String|Null $height = null,
        public String|Null $maxWidth = null,
        public String|Null $maxHeight = null,
        public String|Null $minWidth = null,
        public String|Null $minHeight = null,
        public Radius|Null $radius = null,
        public String|Null $fit = null,
        public String|Null $position = null,
        public Widget|Null $child = null,
    ) { }

    private function getContainerStyle() {
        return new StyleStrategy(
            name: CssTags::class("__image"),
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

        $idStyle->styles[] = new StyleValue(CssTags::BackgroundImage, 'url("'.$this->path.'")');
        $idStyle->styles[] = new StyleValue(CssTags::BackgroundSize, $this->fit ?? ImageFit::Cover);
        $idStyle->styles[] = new StyleValue(CssTags::BackgroundPosition, $this->position ?? ImagePosition::Center);
        
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

        if ($this->radius !== null) {
            $idStyle->styles[] = $this->radius;
        }

        $styles[] = $idStyle;

        return new Element(
            name: 'div',
            id: $id,
            classes: [ "__image" ],
            styles: $styles,
            children:  $this->child !== null 
                ? [ $this->child->createElement() ]
                : [ ],
        );
    }
}