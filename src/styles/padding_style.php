<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../utils.php';

class PaddingEdges extends StyleValue {
    private function __construct(
        public String|Null $left = null,
        public String|Null $right = null,
        public String|Null $top = null,
        public String|Null $bottom = null,
    ) {
        $left = $left ?? Mea::px(0);
        $right = $right ?? Mea::px(0);
        $top = $top ?? Mea::px(0);
        $bottom = $bottom ?? Mea::px(0);

        parent::__construct('padding', $top.' '.$right.' '.$bottom.' '.$left);
    }

    public static function only(
        String $left,
        String $right,
        String $top,
        String $bottom,
    ) : PaddingEdges {
        return new PaddingEdges(
            left: $left,
            right: $right,
            top: $top,
            bottom: $bottom,
        );
    }

    public static function all(
        String $value,
    ) : PaddingEdges {
        return new PaddingEdges(
            left: $value,
            right: $value,
            top: $value,
            bottom: $value,
        );
    }

    public static function symmetric(
        String $horizontal,
        String $vertical,
    ) : PaddingEdges {
        return new PaddingEdges(
            left: $horizontal,
            right: $horizontal,
            top: $vertical,
            bottom: $vertical,
        );
    }
}