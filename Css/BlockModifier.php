<?php

require_once(__DIR__ . "/../Core/GeneratedObject.php");
require_once(__DIR__ . "/../Core/Queue.php");
require_once(__DIR__ . "/ThemeParameter.php");

abstract class BlockModifier extends GeneratedObject
{
  private $Name;
  private $Parameters;

  function __construct(string $name) {
    $this->Name = $name;
    $this->Parameters = new Queue;
    $this->Parameters->SetPrefix(" ", "");
  }

  private function AddParametersFromString(string $name, string $value) {
    $this->Parameters->AddChild(
      (new ThemeParameter)
      ->SetName($name)
      ->SetValue($value)
    );
  }

  private function AddParametersFromClass(ThemeParameter $parameter) {
    $this->Parameters->AddChild($parameter);
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
    return $this->Parameters->GetChilds();
  }

  function GetName() : string {
    return $this->Name;
  }

  function Generate() : string {
    return " {".$this->Parameters->Generate()." }";
  }

}