<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../styles.php';

class Text extends Widget {
    
    public function __construct(
        public String $text,
        public TextTheme|Null $normal = null,
        public TextTheme|Null $hover = null,
        public TextTheme|Null $press = null,
    ) { }

    public function getTextTheme() : StyleStrategy {
        return new StyleStrategy(
            name: CssTags::class('__text'),
            styles: [
                new StyleValue(CssTags::FontSize, Metrica::px(14)),
                new StyleValue(CssTags::FontFamily, "'Segoe UI', Frutiger, 'Frutiger Linotype', 'Dejavu Sans', 'Helvetica Neue', Arial, sans-serif"),
            ],
        );
    }

    public function getNoSelectTextTheme() : StyleStrategy {
        return new StyleStrategy(
            name: CssTags::class('__text_no_select'),
            styles: [
                new StyleValue(CssTags::mozilla(CssTags::UserSelect), CssTags::None),
                new StyleValue(CssTags::safari(CssTags::UserSelect), CssTags::None),
                new StyleValue(CssTags::UserSelect, CssTags::None),
            ]
        );
    }

    public function getIdTheme($id) : StyleStrategy {
        return new StyleStrategy(
            name: CssTags::id($id),
            styles: $this->normal->createTheme(),
        );
    }

    public function getIdHoverTheme($id) : StyleStrategy {
        return new StyleStrategy(
            name: CssTags::id($id),
            action: 'hover',
            styles: $this->hover->createTheme(),
        );
    }

    public function getIdPressTheme($id) : StyleStrategy {
        return new StyleStrategy(
            name: CssTags::id($id),
            action: 'active',
            styles: $this->press->createTheme(),
        );
    }

    public function createElement() : Element {
        $id = GenerateUtil::randomString();

        $themes = [];

        $themes[] = $this->getTextTheme();
        $themes[] = $this->getNoSelectTextTheme();

        if ($this->normal !== null) {
            $themes[] = $this->getIdTheme($id);
        }

        if ($this->hover !== null) {
            $themes[] = $this->getIdHoverTheme($id);
        }

        if ($this->press !== null) {
            $themes[] = $this->getIdPressTheme($id);
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

