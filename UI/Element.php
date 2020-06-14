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
    $this->Arguments = (new Queue)
    ->SetLeftPrefix(" ");
    $this->Parameters = (new Queue)
    ->SetLeftPrefix(" ")
    ->SetRightPrefix(";");
    $this->Keys = (new Queue)
    ->SetLeftPrefix(" ");
  }

  /// Keys
  function SetThemeKeys(array $keys) {
    $this->Keys->SetChilds($keys);
    return $this;
  }

  function AddThemeKeys(array $keys) {
    $this->Keys->AddChilds($keys);
    return $this;
  }

  function AddThemeKey(string $key) {
    $this->Keys->AddChild($key);
    return $this;
  }

  function GetThemesKeys() : array {
    return $this->Keys->GetChilds();
  }

  /// Parameters
  function AddThemeParameter() {
    $this->Parameters->AddChild(ThemeParameter::From(func_get_args(), func_num_args()));
    return $this;
  }

  function GetThemeParameters() : array {
    return $this->Parameters->GetChilds();
  }

  /// Arguments
  function SetArguments(array $arguments) {
    $this->Arguments->SetChilds($arguments);
    return $this;
  }

  function AddArguments(array $arguments) {
    $this->Arguments->AddChilds($arguments);
    return $this;
  }
  
  function AddArgument(Argument $argument) {
    $this->Arguments->AddChild($argument);
    return $this;
  }

  /// ID
  function SetID(string $string) {
    $this->Id = $string;
    return $this;
  }

  function GetID() : string {
    return  $this->Id ;
  }

  // sdo
  function GetArguments() : Queue {
    $arguments = (new Queue)
    ->SetLeftPrefix(" ");
    if (!empty($this->Id))
      $arguments->AddChild(
        (new Argument)
        ->SetName("id")
        ->SetValue($this->Id)
      );
    $arguments->AddChild(
      (new Argument)
      ->SetName("class")
      ->SetValue($this->Keys->Generate())
    );
    $arguments->AddChild(
      (new Argument)
      ->SetName("style")
      ->SetValue($this->Parameters->Generate())
    );
    $arguments->AddChilds($this->Arguments->GetChilds());
    return $arguments;
  }
}