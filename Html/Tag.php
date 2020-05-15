<?php

require_once(__DIR__ . "/../Core/GeneratedObject.php");
require_once(__DIR__ . "/Argument.php");

class Tag extends GeneratedObject
{
  private $Name = "";
  private $Arguments = array();
  private $Child = "";

  function SetName(string $string) {
    $this->Name = $string;
    return $this;
  }

  function GetName() : string {
    return $this->Name;
  }

  function AddArgument(Argument $argument) {
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

  function SetChild($child) {
    if (!is_string($child))
      $child = $child->Generate();
    $this->Child = $child;
    return $this;
  }

  function GetChild() : string {
    return $this->Child;
  }

  private function GenerateArguments() : string {
    $final = "";
    foreach ($this->Arguments as $argument) {
      if (!$argument->Emplty())
        $final .= " ".$argument->Generate();
    }
    return $final;
  }

  function Generate() : string {
    if ($this->Child == "")
      return "<".$this->Name.$this->GenerateArguments()."/>";
    else
      return "<".$this->Name.$this->GenerateArguments().">".$this->Child."</".$this->Name.">";
  }
} 