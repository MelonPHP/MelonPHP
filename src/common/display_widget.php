<?php

abstract class DisplayWidget extends ConfigureWidget {
    public function display() {
        echo $this->createElement()->paint();
    }
}