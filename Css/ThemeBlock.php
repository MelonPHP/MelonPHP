<?php

require_once(__DIR__ . "/../Core/GeneratedObject.php");
require_once(__DIR__ . "/BlockModifier.php");
require_once(__DIR__ . "/../Core/Queue.php");

class ThemeBlock extends GeneratedObject
{
  const ClassType = ".";
  const IdType = "#";
  const LinkType = "@";
  const CoreType = "";

  private $Key = "";
  private $Type = ".";
  private $Modifiers;

  function __construct() {
    $this->Modifiers = new Queue;
  }

  function SetKey(string $string) {
      $this->Key = $string;
      return $this;
  }

  function GetKey() : string {
    return $this->Key;
  }

  function SetType(string $string) {
    $this->Type = $string;
    return $this;
  }

  function GetType() : string {
    return $this->Type;
  }

  function AddModifier(BlockModifier $modifier) {
    $this->Modifiers->AddChild($modifier);
    return $this;
  }

  function GetModifiers() : array {
    return $this->Modifiers->GetChilds();
  }
  
  private function GenerateNames(BlockModifier $modifier) : string {
    $name = str_replace(" ", "", $this->Key);
    $names = explode(",", $name);
    $string = "";
    foreach ($names as $value) {
      $string .= $this->Type.$value
        .($modifier->GetName() != "" ? ":".$modifier->GetName() : "")
        .($modifier->GetSubModifier() != "" ? ":".$modifier->GetSubModifier() : "")
        .",";
    }
    if (strlen($string) > 0)
      $string = substr($string, 0, -1);
    return $string;
  }

  function Generate() : string {
    $string = "";
    foreach ($this->Modifiers->GetChilds() as $modifier) {
      $string .= " ".$this->GenerateNames($modifier).$modifier->Generate();
    }
    return $string;
  }
}