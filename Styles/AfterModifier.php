<?php

require_once(__DIR__ . "/Modifier.php");

class AfterModifier extends Modifier
{
  function __construct() {
    parent::__construct("after");
  }
}