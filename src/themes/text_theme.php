<?php

require_once __DIR__ . '/../common/style_theme.php';
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../styles.php';

class TextTheme extends StyleTheme {
    public function __construct(
        public String|Null $fontSize = null,
        public String|Null $fontWeight = null,
        public String|Null $color = null,
    ) { 
        $fontSize = Metrica::px(14);
        $fontWeight = FontWeight::Regular;
        $color = Color::hex('000000');
    }

    public function createTheme() : Array {
        $array = [
            new StyleValue(CssTags::FontSize, $this->fontSize),
            new StyleValue(CssTags::FontWeight, $this->fontWeight),
            new StyleValue(CssTags::Color, $this->color),
        ];

        return PaintUtil::arrayWhere($array, function ($e) {
            return $e->value != null;
        });
    }
}