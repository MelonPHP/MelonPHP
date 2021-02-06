<?php

require_once __DIR__ . '/widget.php';

abstract class ConfigureWidget extends Widget {
    public function createElement() : Element {
        return $this->build()->createElement();
    }

    public abstract function build() : Widget;
}