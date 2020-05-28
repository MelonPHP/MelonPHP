<?php

require_once(__DIR__ . "/Flex.php");

class Row extends Flex
{
  function __construct() {
    parent::__construct();
    $this->AddThemeKey("__ly_row");
  }
}