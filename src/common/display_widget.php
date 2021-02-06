<?php

require_once __DIR__ . '/configure_widget.php';
require_once __DIR__ . '/../widgets/scaffold.php';

abstract class DisplayWidget extends ConfigureWidget {
    public abstract function build() : Scaffold;

    public function display() {
        echo $this->createElement()->paint();
    }
}