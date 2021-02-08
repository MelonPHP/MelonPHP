<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../utils.php';

abstract class FlexWidget extends Widget {
    public function __construct(
        public String|Null $crossAxisAlign = null,
        public String|Null $mainAxisAlign = null,
        public PaddingEdges|Null $margin = null,
        public Array $children,
    ) { }

    public function createElement() : Element {
        $id = GenerateUtil::randomString();

        $elements = array_map(function ($e) { return $e->createElement(); }, $this->children);

        $styles = [
            new StyleStrategy(
                name: Mea::class("__flex"),
                styles: [ 
                    new StyleValue(CssTags::Width, Mea::pr(100)),
                    new StyleValue(CssTags::Height, Mea::pr(100)),
                    new StyleValue(CssTags::FlexShrink, 0),
                    new StyleValue(CssTags::Left, 0),
                    new StyleValue(CssTags::Flex, CssTags::Auto),
                    new StyleValue(CssTags::Display, Mea::safari(CssTags::Flex)),
                    new StyleValue(CssTags::Display, CssTags::Flex),
                    new StyleValue(CssTags::JustifyContent, CssTags::FlexStart),
                    new StyleValue(CssTags::AlignItems, CssTags::Left),
                ],
            ),
        ];

        $idStyle = new StyleStrategy(
            name: Mea::id($id),
            styles: [ 
                new StyleValue(CssTags::JustifyContent, $this->mainAxisAlign),
                new StyleValue(CssTags::AlignItems, $this->crossAxisAlign),
            ],
        );

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