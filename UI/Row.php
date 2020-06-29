<?php

require_once(__DIR__ . "/Flex.php");

class Row extends Flex
{
  function __construct() {
    parent::__construct();
    $this->ThemeKeys("__ly_row");
  }
}