<?php

require_once __DIR__ . '/../common/style_theme.php';
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../styles.php';

class Borders extends StyleTheme {
    private function __construct(
        public Border|Null $left = null,
        public Border|Null $right = null,
        public Border|Null $top = null,
        public Border|Null $bottom = null,
    ) { }

    public function createTheme() : Array {
        $array = [
            new StyleValue(CssTags::BorderLeft, $this->left?->paint()),
            new StyleValue(CssTags::BorderRight, $this->right?->paint()),
            new StyleValue(CssTags::BorderTop, $this->top?->paint()),
            new StyleValue(CssTags::BorderBottom, $this->bottom?->paint()),
        ];

        return PaintUtil::arrayWhere($array, function ($e) {
            return $e?->value != null;
        });
    }

    public static function only(
        Border|Null $left = null,
        Border|Null $right = null,
        Border|Null $top = null,
        Border|Null $bottom = null,
    ) : Borders {
        return new Borders(
            left: $left,
            right: $right,
            top: $top,
            bottom: $bottom,
        );
    }

    public static function all(
        Border $value,
    ) : Borders {
        return new Borders(
            left: $value,
            right: $value,
            top: $value,
            bottom: $value,
        );
    }

    public static function symmetric(
        Border|Null $horizontal = null,
        Border|Null $vertical = null,
    ) : Borders {
        return new Borders(
            left: $horizontal,
            right: $horizontal,
            top: $vertical,
            bottom: $vertical,
        );
    }
}