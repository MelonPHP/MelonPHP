<?php

require_once(__DIR__ . "/../Includes/Html.php");
require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/Flex.php");

class Column extends Flex
{
  function __construct() {
    parent::__construct();
    $this->AddThemeKey("__ly_column");
  }
}