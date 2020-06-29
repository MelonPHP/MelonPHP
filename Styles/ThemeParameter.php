<?php

require_once(__DIR__ . "/../Core/Node.php");

class ThemeParameter extends Node
{
  private $Name;
  private $Value;

  /// Name
  function SetName(string $name) {
    $this->Name = $name;
    return $this;
  }

  function GetName() : string {
    return $this->Name;
  }

  /// Value
  function SetValue(string $value) {
    $this->Value = $value;
    return $this;
  }

  function GetValue() : string {
    return $this->Value;
  }

  /// Generate
  function Generate() : string {
    return $this->Name.": ".$this->Value;
  }

  /// ----- STATIC -----
  private static function FromQuery(string $name, $query) {
    return (new ThemeParameter)
    ->SetName($name)
    ->SetValue(
      !is_array($query) 
        ? $query
        : SpaceLine($query)
    );
  }

  private static function FromClass(ThemeParameter $parameter) {
    return $parameter;
  }

  static function From(array $args, int $count) : ThemeParameter {
    switch ($count) {
      case 1:
        return ThemeParameter::FromClass($args[0]);
      case 2:
        return ThemeParameter::FromQuery($args[0], $args[1]);
      default:
        throw "bad args count";
    }
  }
}