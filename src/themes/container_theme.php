<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../utils.php';

class ContainerTheme extends StyleTheme {
    public function __construct(
        public String|Null $backgroundColor = null,
        public String|Null $borderRadius = null,
        public String|Null $border = null,
        public String|Null $boxShadows = null,
    ) { }

    public function createTheme() : Array {
        $array = [
            new StyleValue(CssTags::BackgroundColor, $this->backgroundColor),
            new StyleValue(CssTags::BorderRadius, $this->borderRadius),
            new StyleValue(CssTags::Border, $this->border),
            new StyleValue(CssTags::BoxShadow, $this->boxShadows),
        ];

        return PaintUtil::arrayWhere($array, function ($e) {
            return $e->value != null;
        });
    }
}