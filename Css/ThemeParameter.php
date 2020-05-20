<?php

require_once(__DIR__ . "/../Core/GeneratedObject.php");

class ThemeParameter extends GeneratedObject
{
  private $Name;
  private $Value;

  function SetName(string $string) {
      $this->Name = $string;
      return $this;
  }

  function GetName() : string {
    return $this->Name;
  }

  function SetValue(string $string) {
    $this->Value = $string;
    return $this;
  }

  function GetValue() : string {
    return $this->Value;
  }

  function Generate() : string {
    if ($this->Value == null || $this->Value == "")
      return "";
    return $this->Name.": ".$this->Value.";";
  }
}