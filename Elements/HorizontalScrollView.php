<?php

require_once(__DIR__ . "/Container.php");

class HorizontalScrollView extends Container
{
  function __construct() {
    parent::__construct();
    $this->AddThemeKey("__sc_horizontal");
  }
}