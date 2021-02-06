<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../utils.php';

class Text extends Widget {
    
    public function __construct(
        public String $text,
        public TextTheme|Null $theme = null,
        public TextTheme|Null $hoverTheme = null,
    ) { }

    public function createElement() : Element {
        $id = GenerateUtil::randomString();

        $themes = [];

        if ($this->theme !== null) {
            $themes[] = new StyleStrategy(
                name: '#'.$id,
                styles: $this->theme->createTheme(),
            );
        }

        if ($this->hoverTheme !== null) {
            $themes[] = new StyleStrategy(
                name: '#'.$id,
                action: 'hover',
                styles: $this->theme->createTheme(),
            );
        }

        return new Element(
            name: 'p',
            id: $id,
            styles: $themes,
            children: [ new TextPaint($this->text) ],
        );
    }
}

