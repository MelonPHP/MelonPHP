<?php

abstract class DisplayWidget extends ConfigureWidget {
    public abstract function build() : Scaffold;

    public function display() {
        echo $this->createElement()->paint();
    }
}