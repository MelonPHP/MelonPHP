<?php

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