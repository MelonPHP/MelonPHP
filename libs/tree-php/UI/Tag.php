<?php

require_once(__DIR__ . "/../Core/Node.php");
require_once(__DIR__ . "/../Core/Queue.php");
require_once(__DIR__ . "/Argument.php");

class Tag extends Node
{
  private $Arguments;

  private $Name = "";
  private $Child = "";

  function __construct() {
    $this->Arguments = (new Queue)
    ->LeftPrefix(" ");
  }

  /// Name
  function Name(string $string) {
    $this->Name = $string;
    return $this;
  }

  function GetName() : string {
    return $this->Name;
  }

  // Arguments
  function Arguments($arguments) {
    $this->Arguments->Children($arguments);
    return $this;
  }

  function GetArguments() : array {
    return $this->Arguments->GetChildren();
  }

  /// Child
  function Child($child) {
    if (!is_string($child))
      $child = $child->Generate();
    $this->Child = $child;
    return $this;
  }

  function GetChild() : string {
    return $this->Child;
  }

  /// Generate
  function Generate() : string {
    if (empty($this->Child))
      return "<".$this->Name.$this->Arguments->Generate()."/>";
    else
      return "<".$this->Name.$this->Arguments->Generate().">".$this->Child."</".$this->Name.">";
  }
}