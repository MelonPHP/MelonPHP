<?php

require_once(__DIR__ . "/Component.php");
require_once(__DIR__ . "/../Core/Queue.php");

class Builder extends Node
{
  private $Function;
  private $Arguments;

  function __construct() {
    $this->Arguments = new Queue;
  }

  function Arguments($arguments) {
    $this->Arguments->Children($arguments);
    return $this;
  }

  function GetArguments() : array {
    return $this->Arguments->GetChildren();
  }

  function Function($func) {
    $this->Function = $func;
    return $this;
  }

  function GetFunction() {
    return $this->Function;
  }

  public function Generate() : string {
    if ($this->Function != null)
      return call_user_func($this->Function, $this->Arguments->GetChildren())->Generate();
  }
}