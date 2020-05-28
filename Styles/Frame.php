<?php

require_once(__DIR__ . "/../Core/Node.php");
require_once(__DIR__ . "/../Core/Queue.php");
require_once(__DIR__ . "/ThemeParameter.php");

class Frame extends Node 
{
  private $Parameters;
  private $Value = "";

  function __construct() {
    $this->Parameters = (new Queue)
    ->SetLeftPrefix(" ")
    ->SetRightPrefix(";");
  }

  /// Parameters
  function AddParameter() {
    $this->Parameters->AddChild(ThemeParameter::From(func_get_args(), func_num_args()));
    return $this;
  }

  function GetParameters() : array {
    return $this->Parameters->GetChilds();
  }

  /// Value
  function SetValue(string $string) {
    $this->Value = $string;
    return $this;
  }

  function GetValue() : string {
    return $this->Value;
  }

  /// Generate
  function Generate() : string {
    return $this->Value." {".$this->Parameters->Generate()." }";
  }
}