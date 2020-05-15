<?php

require_once(__DIR__ . "/BlockModifier.php");

class ActiveModifier extends BlockModifier
{
  function __construct() {
    parent::__construct("active");
  }
}