<?php

require_once(__DIR__ . "/Container.php");

class Center extends Container
{
  function __construct() {
    parent::__construct();
    $this->AddThemeKey("__center");
  }
}