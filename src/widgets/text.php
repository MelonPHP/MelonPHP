<?php

require_once __DIR__ . '/../styles/padding_style.php';
require_once __DIR__ . '/../common/widget.php';

abstract class FontWeight {
    const Regular = '400';
    const Medium = '500';
    const Bold = '900';
}

class TextTheme extends StyleTheme {
    public function __construct(
        public String $fontSize,
        public String $fontWeight,
        public String $color,
    ) { }

    public function createTheme() : Array {
        return [
            new StyleValue('font-size', $this->fontSize),
            new StyleValue('font-weight', $this->fontWeight),
            new StyleValue('color', $this->color),
        ];
    }
}

class TextPaint extends Paint {
    public function __construct(
        public String $text,
    ) { }

    public function paint() : String {
        return $this->text;
    }
}

class Text extends Widget {
    public function __construct(
        public String $text,
        public TextTheme|Null $theme = null,
        public TextTheme|Null $hoverTheme = null,
    ) { }

    public function createElement() : Element {
        $id = GenerateUtil::randomString();

        $themes = [];

        if ($this->theme !== null) {
            $themes[] = new StyleStrategy(
                name: '#'.$id,
                styles: $this->theme->createTheme(),
            );
        }

        if ($this->hoverTheme !== null) {
            $themes[] = new StyleStrategy(
                name: '#'.$id,
                action: 'hover',
                styles: $this->theme->createTheme(),
            );
        }

        return new Element(
            name: 'p',
            id: $id,
            styles: $themes,
            children: [ new TextPaint($this->text) ],
        );
    }
}

