<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../utils.php';

class Text extends Widget {
    
    public function __construct(
        public String $text,
        public TextTheme|Null $theme = null,
        public TextTheme|Null $hoverTheme = null,
    ) { }

    public function createElement() : Element {
        $id = GenerateUtil::randomString();

        $themes = [
            new StyleStrategy(
                name: Mea::class('__text'),
                styles: [
                    new StyleValue(CssTags::FontSize, Mea::px(14)),
                    new StyleValue(CssTags::FontFamily, "'Segoe UI', Frutiger, 'Frutiger Linotype', 'Dejavu Sans', 'Helvetica Neue', Arial, sans-serif"),
                ]
            ),
            new StyleStrategy(
                name: Mea::class('__text_no_select'),
                styles: [
                    new StyleValue(Mea::mozilla(CssTags::UserSelect), CssTags::None),
                    new StyleValue(Mea::safari(CssTags::UserSelect), CssTags::None),
                    new StyleValue(CssTags::UserSelect, CssTags::None),
                ]
            ),
        ];

        // TODO: Refactor

        if ($this->theme !== null) {
            $themes[] = new StyleStrategy(
                name: Mea::Id($id),
                styles: $this->theme->createTheme(),
            );
        }

        if ($this->hoverTheme !== null) {
            $themes[] = new StyleStrategy(
                name: Mea::Id($id),
                action: 'hover',
                styles: $this->hoverTheme->createTheme(),
            );
        }

        return new Element(
            name: 'p',
            id: $id,
            styles: $themes,
            classes: [ '__text', '__text_no_select' ],
            children: [ new TextPaint($this->text) ],
        );
    }
}

