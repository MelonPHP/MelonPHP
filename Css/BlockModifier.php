<?php

require_once(__DIR__ . "/../Core/GeneratedObject.php");
require_once(__DIR__ . "/ThemeParameter.php");

abstract class BlockModifier extends GeneratedObject
{
  private $Name;
  private $Parameters = array();

  function __construct(string $name) {
    $this->Name = $name;
  }

  private function AddParametersFromString(string $name, string $value) {
    array_push(
      $this->Parameters
      ,(new ThemeParameter)
      ->SetName($name)
      ->SetValue($value)
    );
  }

  private function AddParametersFromClass(ThemeParameter $parameter) {
    array_push($this->Parameters, $parameter);
  }

  function AddParameter() {
    $args = func_get_args();
    $argsCount = func_num_args();

    switch ($argsCount) {
      case 1:
        $this->AddParametersFromClass($args[0]);
        break;
      case 2:
        $this->AddParametersFromString($args[0], $args[1]);
        break;
      default:
        throw "bad args count";
    }
    return $this;
  }

  function GetParameters() : array {
    return $this->Parameters;
  }

  function GetName() : string {
    return $this->Name;
  }

  private function GenerateParameters() : string {
    $string = "";
    foreach ($this->Parameters as $value) {
      $string .= " ".$value->Generate();
    }
    return $string;
  }

  function Generate() : string {
    $body = " {".$this->GenerateParameters()." }";
    return $this->GetName() != "" ? ":".$this->GetName().$body : $body;  
  }

}