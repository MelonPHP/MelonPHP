<?php

require_once(__DIR__ . "/Modifier.php");

class ActiveModifier extends Modifier
{
  function __construct() {
    parent::__construct("active");
  }
}