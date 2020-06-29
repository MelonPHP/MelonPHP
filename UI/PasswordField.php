<?php

require_once(__DIR__ . "/Field.php");

class PasswordField extends Field
{
  function __construct() {
    parent::__construct();
    $this->Type = "password";
  }
}