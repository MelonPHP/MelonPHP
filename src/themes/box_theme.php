<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../utils.php';

class BoxTheme extends StyleTheme {
    public function __construct(
        public String|Null $color = null,
        public Radius|Null $radius = null,
        public Borders|Null $border = null,
        public Shadows|Null $shadows = null,
    ) { }

    public function createTheme() : Array {
        $array = [
            new StyleValue(CssTags::BackgroundColor, $this->color),
            $this->radius,
            $this->shadows,
        ];

        $theme = $this->border?->createTheme();
        
        if ($theme !== null) {
            $array = array_merge($array, $theme);
        }

        return PaintUtil::arrayWhere($array, function ($e) {
            return $e?->value != null;
        });
    }
}