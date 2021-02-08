<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../common/style_value.php';
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/metrica.php';
require_once __DIR__ . '/css_tags.php';

class Border extends Paint {
    public function __construct(
        public String|Null $width = null,
        public String|Null $color = null,
        public String|Null $type = null,
    ) { 
        $this->width = $width ?? Metrica::px(0);
        $this->type = $type ?? 'solid';

        $this->color = $color ?? Color::hex('000');
    }

    function paint() : String {
        return $this->width.' '.$this->type.' '.$this->color;
    }
}