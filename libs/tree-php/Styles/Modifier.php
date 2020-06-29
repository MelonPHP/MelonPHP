<?php

require_once(__DIR__ . "/../Core/Node.php");
require_once(__DIR__ . "/../Core/Queue.php");
require_once(__DIR__ . "/ThemeParameter.php");

abstract class Modifier extends Node
{
  private $Parameters;
  private $Name = "";

  function __construct(string $name) {
    $this->Parameters = (new Queue)
    ->LeftPrefix(" ")
    ->RightPrefix(";");
    $this->Name = $name;
  }

  /// Parameters
  function Parameter() {
    $this->Parameters->Children([ThemeParameter::From(func_get_args(), func_num_args())]);
    return $this;
  }

  function GetParameters() : array {
    return $this->Parameters->GetChildren();
  }

  /// Name
  function GetName() : string {
    return $this->Name;
  }

  /// Generate
  function Generate() : string {
    return " {".$this->Parameters->Generate()." }";
  }
}