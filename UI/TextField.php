<?php

require_once(__DIR__ . "/Field.php");

class TextField extends Field
{
  function __construct() {
    parent::__construct();
    $this->Type = "text";
  }
}