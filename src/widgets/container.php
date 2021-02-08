<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../themes.php';

class Container extends Widget {
    public function __construct(
        public String|Null $width = null,
        public String|Null $height = null,
        public String|Null $maxWidth = null,
        public String|Null $maxHeight = null,
        public String|Null $minWidth = null,
        public String|Null $minHeight = null,
        public ContainerTheme|Null $theme = null,
        public ContainerTheme|Null $hoverTheme = null,
        public ContainerTheme|Null $pressTheme = null,
        public Widget|Null $child = null,
    ) { }

    public function createElement() : Element {
        $id = GenerateUtil::randomString();

        $themes = [
            new StyleStrategy(
                name: Mea::class("__container"),
                styles: [ 
                    new StyleValue(CssTags::Width, Mea::pr(100)),
                    new StyleValue(CssTags::Height, Mea::pr(100)),
                    new StyleValue(CssTags::Display, CssTags::Block),
                ],
            ),
        ];

        $styleMain = new StyleStrategy(
            name: Mea::Id($id),
            styles: [],
        );

        if ($this->theme !== null) {
            $styleMain->styles = array_merge($styleMain->styles, $this->theme->createTheme());
        }

        if ($this->width !== null) {
            $styleMain->styles[] = new StyleValue(CssTags::Width, $this->width);
        }

        if ($this->height !== null) {
            $styleMain->styles[] = new StyleValue(CssTags::Height, $this->height);
        }

        if ($this->maxWidth !== null) {
            $styleMain->styles[] = new StyleValue(CssTags::MaxWidth, $this->maxWidth);
        }

        if ($this->maxHeight !== null) {
            $styleMain->styles[] = new StyleValue(CssTags::MaxHeight, $this->maxHeight);
        }

        if ($this->minWidth !== null) {
            $styleMain->styles[] = new StyleValue(CssTags::MinWidth, $this->minWidth);
        }

        if ($this->minHeight !== null) {
            $styleMain->styles[] = new StyleValue(CssTags::MinHeight, $this->minHeight);
        }

        $themes[] = $styleMain;

        if ($this->hoverTheme !== null) {
            $themes[] = new StyleStrategy(
                name: Mea::Id($id),
                action: 'hover',
                styles: $this->hoverTheme->createTheme(),
            );
        }

        if ($this->pressTheme !== null) {
            $themes[] = new StyleStrategy(
                name: Mea::Id($id),
                action: 'active',
                styles: $this->pressTheme->createTheme(),
            );
        }

        return new Element(
            name: 'div',
            id: $id,
            classes: [ "__container" ],
            styles: $themes,
            children:  $this->child !== null 
                ? [ $this->child->createElement() ]
                : [ ],
        );
    }
}