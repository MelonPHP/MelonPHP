<?php

require_once(__DIR__ . "/BlockModifier.php");

class AfterModifier extends BlockModifier
{
  function __construct() {
    parent::__construct("after");
  }
}