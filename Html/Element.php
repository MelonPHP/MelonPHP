<?php

require_once(__DIR__ . "/../Core/GeneratedObject.php");
require_once(__DIR__ . "/../Css/ThemeParameter.php");

abstract class Element extends GeneratedObject
{
  private $Arguments = array();
  private $StyleArgument;
  private $ClassArgument;

  function __construct() {
    $this->StyleArgument = (new Argument)->SetName("style");
    $this->ClassArgument = (new Argument)->SetName("class");
  }

  function AddThemeKey(string $key) {
    $this->ClassArgument
    ->AddItem($key);
    return $this;
  }

  function GetThemesKeys() : array {
    return $this->ClassArgument
    ->GetItems();
  }

  private function AddThemeParametersFromString(string $name, string $value) {
    $this->StyleArgument
    ->AddItem(
      (new ThemeParameter)
      ->SetName($name)
      ->SetValue($value)
      ->Generate()
    );
  }

  private function AddThemeParametersFromClass(ThemeParameter $parameter) {
    $this->StyleArgument
    ->AddItem($parameter->Generate());
  }

  function AddThemeParameter() {
    $args = func_get_args();
    $argsCount = func_num_args();

    switch ($argsCount) {
      case 1:
        $this->AddThemeParametersFromClass($args[0]);
        break;
      case 2:
        $this->AddThemeParametersFromString($args[0], $args[1]);
        break;
      default:
        throw "bad args count";
    }
    return $this;
  }

  function AddArgument(Argument $argument) {
    array_push($this->Arguments, $argument);
    return $this;
  }

  function GetArguments() : array {
    $arguments = array();
    array_push($arguments, $this->ClassArgument);
    array_push($arguments, $this->StyleArgument);
    foreach ($this->Arguments as $argument) {
      array_push($arguments, $argument);
    }
    return $arguments;
  }
}