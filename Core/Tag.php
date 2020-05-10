<?php namespace Generator;

require_once("Html.php");
require_once("Argument.php");

class Tag extends Html
{
  private $Name = "";
  private $Arguments = array();
  private $Child;

  function SetName(string $string) {
    $this->Name = $string;
    return $this;
  }

  function GetName() : array {
    return $this->Name;
  }

  function AddArgument(Argument $argument) {
    array_push($this->Arguments, $argument);
    return $this;
  }

  function GetArguments() : array {
    return $this->Arguments;
  }

  function SetChild(string $child) {
    $this->Child = $child;
    return $this;
  }

  function GetChild() {
    return $this->Child;
  }

  private function GenerateArguments() : string {
    $final = "";
    foreach ($this->Arguments as $argument) {
      $final .= " ".$argument->Generate();
    }
    return $final;
  }

  function Generate() : string {
    if ($this->Child == null)
      return "<".$this->Name.$this->GenerateArguments()."/>";
    else
      return "<".$this->Name.$this->GenerateArguments().">".$this->Child."<".$this->Name."/>";
  }
}