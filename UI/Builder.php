<?php

require_once(__DIR__ . "/Component.php");

class Builder extends Component
{
  private $Function;
  private $Arguments = array();

  function AddArgument($argument) {
    array_push($this->Arguments, $argument);
    return $this;
  }

  function AddArguments(array $arguments) {
    foreach ($arguments as $argument) {
      array_push($this->Arguments, $argument);
    }
    return $this;
  }

  function GetArguments() : array {
    return $this->Arguments;
  }

  function SetFunction($func) {
    $this->Function = $func;
    return $this;
  }

  function GetFunction() {
    return $this->Function;
  }

  public function Build() : Node {
    if ($this->Function != null)
      return call_user_func($this->Function, $this->Arguments);
  }
}