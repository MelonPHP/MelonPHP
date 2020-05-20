<?php

require_once(__DIR__ . "/BlockModifier.php");

class BeforeModifier extends BlockModifier
{
  function __construct() {
    parent::__construct("before");
  }
}