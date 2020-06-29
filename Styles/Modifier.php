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
    ->SetLeftPrefix(" ")
    ->SetRightPrefix(";");
    $this->Name = $name;
  }

  /// Parameters
  function AddParameter() {
    $this->Parameters->AddChild(ThemeParameter::From(func_get_args(), func_num_args()));
    return $this;
  }

  function GetParameters() : array {
    return $this->Parameters->GetChilds();
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