<?php

require_once __DIR__ . '/configure_widget.php';
require_once __DIR__ . '/../widgets.php';

abstract class DisplayWidget extends ConfigureWidget {
    public abstract function build() : Scaffold;

    public function display() {
        echo $this->build()->createElement()->paint();
    }
}