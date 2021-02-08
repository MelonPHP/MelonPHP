<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../utils.php';

class BoxTheme extends StyleTheme {
    public function __construct(
        public String|Null $color = null,
        public String|Null $radius = null,
        public String|Null $border = null,
        public String|Null $shadows = null,
    ) { }

    public function createTheme() : Array {
        $array = [
            new StyleValue(CssTags::BackgroundColor, $this->color),
            new StyleValue(CssTags::BorderRadius, $this->radius),
            new StyleValue(CssTags::Border, $this->border),
            new StyleValue(CssTags::BoxShadow, $this->shadows),
        ];

        return PaintUtil::arrayWhere($array, function ($e) {
            return $e->value != null;
        });
    }
}