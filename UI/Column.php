<?php

require_once(__DIR__ . "/Flex.php");

class Column extends Flex
{
  function __construct() {
    parent::__construct();
    $this->AddThemeKey("__ly_column");
  }
}