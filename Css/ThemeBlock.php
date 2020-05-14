<?php

require_once(__DIR__ . "/../Core/GeneratedObject.php");
require_once(__DIR__ . "/BlockModifier.php");

class ThemeBlock extends GeneratedObject
{
  const ClassType = ".";
  const IdType = "#";
  const CoreType = "";

  private $Name = "";
  private $Type = ".";
  private $Modifiers = array();

  function SetName(string $string) {
      $this->Name = $string;
      return $this;
  }

  function GetName() : string {
    return $this->Name;
  }

  function SetType(string $string) {
    $this->Type = $string;
    return $this;
  }

  function GetType() : string {
    return $this->Type;
  }

  function AddModifier(BlockModifier $modifier) {
    array_push($this->Modifiers, $modifier);
    return $this;
  }

  function GetModifiers() : array {
    return $this->Modifiers;
  }
  
  private function GenerateNames() : string {
    $name = str_replace(" ", "", $this->Name);
    $names = explode(",", $name);
    $string = "";
    foreach ($names as $value) {
      $string .= $this->Type.$value.",";
    }
    if (count($string) > 0)
      $string = substr($string, 0, -1);
    return $string;
  }

  function Generate() : string {
    $string = "";
    foreach ($this->Modifiers as $modifier) {
      $string .= " ".$this->GenerateNames().$modifier->Generate();
    }
    return $string;
  }
}