<?php

require_once(__DIR__ . "/../Includes/Core.php");

class Argument extends Node
{
  private $Name = "";
  private $Value = "";

  /// Name
  function SetName(string $string) {
    $this->Name = $string;
    return $this;
  }

  function GetName() : string {
    return $this->Name;
  }

  /// Value
  function SetValue(string $string) {
    $this->Value = $string;
    return $this;
  }

  function GetValue() : string {
    return $this->Value;
  }

  /// Sub_ Pi FUCK!
  function Empty() : bool {
    return empty($this->Name) || empty($this->Value);
  }

  // Generate
  function Generate() : string {
    return $this->Name."='".$this->Value."'";
  }
}