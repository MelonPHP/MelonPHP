<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../common/style_value.php';
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/metrica.php';
require_once __DIR__ . '/css_tags.php';

class Shadow extends Paint {
    public function __construct(
        public String|Null $x = null,
        public String|Null $y = null,
        public String|Null $radius = null,
        public String|Null $spread = null,
        public String|Null $color = null,
    ) { 
        $this->x = $x ?? Metrica::px(0);
        $this->y = $y ?? Metrica::px(0);

        $this->radius = $radius ?? Metrica::px(0);
        $this->spread = $spread ?? Metrica::px(0);

        $this->color = $color ?? Color::hex('000');
    }

    function paint() : String {
        return $this->x.' '.$this->y.' '.$this->radius.' '.$this->spread.' '.$this->color;
    }
}