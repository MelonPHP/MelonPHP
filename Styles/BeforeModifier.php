<?php

require_once(__DIR__ . "/Modifier.php");

class BeforeModifier extends Modifier
{
  function __construct() {
    parent::__construct("before");
  }
}