<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../styles.php';

abstract class FlexWidget extends Widget {
    public function __construct(
        public String|Null $crossAxisAlign = null,
        public String|Null $mainAxisAlign = null,
        public Edges|Null $margin = null,
        public Array $children,
    ) { }

    private function getFlexStyle() {
        return new StyleStrategy(
            name: CssTags::class("__flex"),
            styles: [ 
                new StyleValue(CssTags::Width, Metrica::pr(100)),
                new StyleValue(CssTags::Height, Metrica::pr(100)),
                new StyleValue(CssTags::FlexShrink, 0),
                new StyleValue(CssTags::Left, 0),
                new StyleValue(CssTags::Flex, CssTags::Auto),
                new StyleValue(CssTags::Display, CssTags::safari(CssTags::Flex)),
                new StyleValue(CssTags::Display, CssTags::Flex),
                new StyleValue(CssTags::JustifyContent, CssTags::FlexStart),
                new StyleValue(CssTags::AlignItems, CssTags::Left),
            ],
        );
    }

    private function getIdStyle($id) {
        return new StyleStrategy(
            name: CssTags::id($id),
            styles: [ 
                new StyleValue(CssTags::JustifyContent, $this->mainAxisAlign),
                new StyleValue(CssTags::AlignItems, $this->crossAxisAlign),
            ],
        );
    }

    public function createElement() : Element {
        $id = GenerateUtil::randomString();

        $elements = array_map(function ($e) { return $e->createElement(); }, $this->children);

        $styles = [];

        $styles[] = $this->getFlexStyle();

        $idStyle = $this->getIdStyle($id);
        if ($this->margin != null) {
            $idStyle->styles[] = $this->margin;
        }
        $styles[] = $idStyle;

        return new Element(
            name: 'div',
            id: $id,
            classes: [
                '__flex'
            ],
            styles: $styles,
            children: $elements,
        );
    }
}