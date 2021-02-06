<?php

class TextTheme extends StyleTheme {
    public function __construct(
        public String|Null $fontSize = null,
        public String|Null $fontWeight = null,
        public String|Null $color = null,
    ) { 
        $this->fontSize = Css::Px(14);
        $this->fontWeight = FontWeight::Regular;
        $this->color = Css::Hex('000000');
    }

    public function createTheme() : Array {
        return [
            new StyleValue('font-size', $this->fontSize),
            new StyleValue('font-weight', $this->fontWeight),
            new StyleValue('color', $this->color),
        ];
    }
}