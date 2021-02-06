<?php

require_once __DIR__ . '/style.php';

class PaddingStyle extends Style {
    private function __construct(
        public String $left,
        public String $right,
        public String $top,
        public String $bottom,
    ) {
        parent::__construct('padding', $top.' '.$right.' '.$bottom.' '.$left);
    }

    public static function only(
        String $left = '0px',
        String $right = '0px',
        String $top = '0px',
        String $bottom = '0px',
    ) : PaddingStyle {
        return new PaddingStyle(
            left: $left,
            right: $right,
            top: $top,
            bottom: $bottom,
        );
    }

    public static function all(
        String $value,
    ) : PaddingStyle {
        return new PaddingStyle(
            left: $value,
            right: $value,
            top: $value,
            bottom: $value,
        );
    }

    public static function symmetric(
        String $horizontal = '0px',
        String $vertical = '0px',
    ) : PaddingStyle {
        return new PaddingStyle(
            left: $horizontal,
            right: $horizontal,
            top: $vertical,
            bottom: $vertical,
        );
    }
}