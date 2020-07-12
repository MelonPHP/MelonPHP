<?php

require_once(__DIR__ . "/Component.php");

abstract class ThinkingComponent extends Component
{
  function Think() { }

  function __construct() {
    parent::__construct();
    $this->Think();
  }
}