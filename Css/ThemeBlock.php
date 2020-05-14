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

  function Generate() : string {
    $string = "";
    foreach ($this->Modifiers as $modifier) {
      $string .= " ".$this->Type.$this->GetName().$modifier->Generate();
    }
    return $string;
  }
}