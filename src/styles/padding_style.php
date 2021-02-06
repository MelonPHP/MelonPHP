<?php

require_once __DIR__ . '/style.php';

class PaddingValue extends StyleValue {
    private function __construct(
        public String $left,
        public String $right,
        public String $top,
        public String $bottom,
    ) {
        $left = $left ?? Css::Px(0);
        $right = $right ?? Css::Px(0);
        $top = $top ?? Css::Px(0);
        $bottom = $bottom ?? Css::Px(0);

        parent::__construct('padding', $top.' '.$right.' '.$bottom.' '.$left);
    }

    public static function only(
        String $left,
        String $right,
        String $top,
        String $bottom,
    ) : PaddingValue {
        return new PaddingValue(
            left: $left,
            right: $right,
            top: $top,
            bottom: $bottom,
        );
    }

    public static function all(
        String $value,
    ) : PaddingValue {
        return new PaddingValue(
            left: $value,
            right: $value,
            top: $value,
            bottom: $value,
        );
    }

    public static function symmetric(
        String $horizontal,
        String $vertical,
    ) : PaddingValue {
        return new PaddingValue(
            left: $horizontal,
            right: $horizontal,
            top: $vertical,
            bottom: $vertical,
        );
    }
}