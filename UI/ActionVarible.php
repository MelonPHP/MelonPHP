<?php

require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/ActionNode.php");
require_once(__DIR__ . "/Tag.php");

class ActionVarible extends ActionNode
{
  function __construct() {
    parent::__construct();
    $this->Type = "hidden";
  }

  /// Value
  function Value($string) {
    $this->Value = $string;
    return $this;
  }

  function GetValue() : string {
    return $this->Value;
  }

  /// Generate
  function Generate() : string {
    return Tag::Create()
    ->Name("input")
    ->Arguments($this->GetArguments()->GetChildren())
    ->Generate();
  }
}