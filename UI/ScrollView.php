<?php

require_once(__DIR__ . "/Container.php");

class ScrollView extends Container
{
  function __construct() {
    parent::__construct();
    $this->ThemeKeys(["__sc_all"]);
  }
}