<?php

abstract class ConfigWidget extends Widget {
    public function createElement() : Element {
        return $this->build()->createElement();
    }

    public abstract function build() : Widget;
}