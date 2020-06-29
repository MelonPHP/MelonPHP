<?php

require_once(__DIR__ . "/../Core/Queue.php");
require_once(__DIR__ . "/../Core/Node.php");
require_once(__DIR__ . "/../Styles/ThemeParameter.php");
require_once(__DIR__ . "/../Styles/CssConstants.php");

abstract class Element extends Node
{
  private $Arguments;
  private $Parameters;
  private $Keys;
  private $Id = "";

  function __construct() {
    $this->Arguments = Queue::Create()
    ->LeftPrefix(" ");
    $this->Parameters = Queue::Create()
    ->LeftPrefix(" ")
    ->RightPrefix(";");
    $this->Keys = (new Queue)
    ->LeftPrefix(" ");
  }

  /// Keys
  function ThemeKeys($keys) {
    $this->Keys->Children($keys);
    return $this;
  }

  function GetThemesKeys() : array {
    return $this->Keys->GetChildren();
  }

  /// Parameters
  function ThemeParameter() {
    $this->Parameters->Children([ThemeParameter::From(func_get_args(), func_num_args())]);
    return $this;
  }

  function GetThemeParameters() : array {
    return $this->Parameters->GetChildren();
  }

  /// Arguments
  function Arguments($arguments) {
    $this->Arguments->Children($arguments);
    return $this;
  }

  /// ID
  function ID(string $string) {
    $this->Id = $string;
    return $this;
  }

  function GetID() : string {
    return  $this->Id ;
  }

  // sdo
  function GetArguments() : Queue {
    $arguments = Queue::Create()
    ->LeftPrefix(" ");
    if (!empty($this->Id))
      $arguments->Children([
        Argument::Create()
        ->Name("id")
        ->Value($this->Id)
      ]);
    $arguments->Children([
      Argument::Create()
      ->Name("class")
      ->Value($this->Keys->Generate())
    ]);
    $arguments->Children([
      (new Argument)
      ->Name("style")
      ->Value($this->Parameters->Generate())
    ]);
    $arguments->Children($this->Arguments->GetChildren());
    return $arguments;
  }
}