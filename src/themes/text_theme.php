<?php

require_once __DIR__ . '/../common/style_theme.php';
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../styles.php';

class TextTheme extends StyleTheme {
    public function __construct(
        public String|Null $size = null,
        public String|Null $weight = null,
        public String|Null $color = null,
    ) { 
        $size = Metrica::px(14);
        $weight = FontWeight::Regular;
        $color = Color::hex('000000');
    }

    public function createTheme() : Array {
        $array = [
            new StyleValue(CssTags::FontSize, $this->size),
            new StyleValue(CssTags::FontWeight, $this->weight),
            new StyleValue(CssTags::Color, $this->color),
        ];

        return PaintUtil::arrayWhere($array, function ($e) {
            return $e?->value != null;
        });
    }
}