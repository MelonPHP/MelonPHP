<?php

require_once(__DIR__ . "/../Includes/Core.php");

abstract class Component extends Element
{
  function Initialize() { }
  
  function Detach() { }

  function __construct() {
    parent::__construct();
    $this->Initialize();
  }

  function __destruct() {
    $this->Detach();
  }

  abstract function Build() : Element;

  public function Generate() : string {
    return $this->Build()
    ->Arguments($this->GetArguments()->GetChildren())
    ->Generate();
  }
}