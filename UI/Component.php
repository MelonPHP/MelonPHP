<?php

require_once(__DIR__ . "/../Includes/Core.php");

abstract class Component extends Element
{
  abstract function Build() : Element;

  public function Generate() : string {
    return $this->Build()
    ->Arguments($this->GetArguments()->GetChildren())
    ->Generate();
  }
}