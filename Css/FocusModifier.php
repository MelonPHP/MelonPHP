<?php

require_once(__DIR__ . "/BlockModifier.php");

class FocusModifier extends BlockModifier
{
  function __construct() {
    parent::__construct("focus");
  }
}