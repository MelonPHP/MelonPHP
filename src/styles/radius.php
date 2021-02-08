<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../common/style_value.php';
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/metrica.php';
require_once __DIR__ . '/css_tags.php';

class Radius extends StyleValue {
    private function __construct(
        public String|Null $left = null,
        public String|Null $right = null,
        public String|Null $top = null,
        public String|Null $bottom = null,
    ) {
        $left = $left ?? Metrica::px(0);
        $right = $right ?? Metrica::px(0);
        $top = $top ?? Metrica::px(0);
        $bottom = $bottom ?? Metrica::px(0);

        parent::__construct(CssTags::BorderRadius, $top.' '.$right.' '.$bottom.' '.$left);
    }

    public static function only(
        String $left,
        String $right,
        String $top,
        String $bottom,
    ) : Radius {
        return new Radius(
            left: $left,
            right: $right,
            top: $top,
            bottom: $bottom,
        );
    }

    public static function all(
        String $value,
    ) : Radius {
        return new Radius(
            left: $value,
            right: $value,
            top: $value,
            bottom: $value,
        );
    }

    public static function symmetric(
        String $horizontal,
        String $vertical,
    ) : Radius {
        return new Radius(
            left: $horizontal,
            right: $horizontal,
            top: $vertical,
            bottom: $vertical,
        );
    }
}