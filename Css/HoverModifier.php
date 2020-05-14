<?php

require_once(__DIR__ . "/BlockModifier.php");

class HoverModifier extends BlockModifier
{
  function __construct() {
    parent::__construct("hover");
  }
}