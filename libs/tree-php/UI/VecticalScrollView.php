<?php

require_once(__DIR__ . "/Container.php");

class VerticalScrollView extends Container
{
  function __construct() {
    parent::__construct();
    $this->ThemeKeys(["__sc_vertical"]);
  }
}