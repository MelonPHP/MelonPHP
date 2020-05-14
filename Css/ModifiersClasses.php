<?php

require_once(__DIR__ . "/BlockModifier.php");

class StandartModifier extends BlockModifier
{
  function __construct() {
    parent::__construct("");
  }
}

class HoverModifier extends BlockModifier
{
  function __construct() {
    parent::__construct("hover");
  }
}

class FocusModifier extends BlockModifier
{
  function __construct() {
    parent::__construct("focus");
  }
}