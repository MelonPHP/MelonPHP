<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../common/style_value.php';
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/metrica.php';
require_once __DIR__ . '/css_tags.php';
require_once __DIR__ . '/shadow.php';

class Shadows extends StyleValue {
    public function __construct(
        public Array $shadows,
    ) {
        $result = substr(PaintUtil::bufferPaint($shadows, separator: ', '), 2);
        parent::__construct(CssTags::BoxShadow, $result);
    }

    public static function one(
        String|Null $x = null,
        String|Null $y = null,
        String|Null $radius = null,
        String|Null $spread = null,
        String|Null $color = null,
    ) : Shadows {
        return new Shadows([
            new Shadow(x: $x, y: $y, radius: $radius, spread: $spread, color: $color),
        ]);
    }
}