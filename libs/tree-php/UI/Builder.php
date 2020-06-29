<?php

require_once(__DIR__ . "/Component.php");

class Builder extends Node
{
  private $Function;
  private $Arguments;

  function __construct() {
    $Arguments = Queue::Create();
  }

  function Arguments($arguments) {
    $this->Arguments->Children($arguments);
    return $this;
  }

  function GetArguments() : array {
    return $this->Arguments;
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
      return call_user_func($this->Function, $this->Arguments)->Generate();
  }
}