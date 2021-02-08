<?php

require_once __DIR__ . '/flex.php';
require_once __DIR__ . '/../utils.php';
require_once __DIR__ . '/../styles.php';

class Column extends FlexWidget {

    public function createElement() : Element {
        $result = parent::createElement();

        $result->styles[] = new StyleStrategy(
            name: CssTags::class("__column"),
            styles: [ 
                new StyleValue(CssTags::FlexDirection, CssTags::Column),
                new StyleValue(CssTags::safari(CssTags::FlexDirection), CssTags::Column),
            ],
        );

        foreach ($result->styles as &$value) {
            $value->styles = PaintUtil::arrayWhere($value->styles, function ($e) {
                return $e->value != null;
            });
        }

        $result->classes[] = '__column';

        return $result;
    }
}