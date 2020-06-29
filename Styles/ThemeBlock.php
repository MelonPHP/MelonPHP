<?php

require_once(__DIR__ . "/../Core/Node.php");
require_once(__DIR__ . "/../Core/Queue.php");
require_once(__DIR__ . "/Modifier.php");

class ThemeBlock extends Node 
{
  private $Modifiers;
  private $Keys;
  private $Type = ".";

  function __construct() {
    $this->Modifiers = (new Queue)
    ->LeftPrefix(" ");
    $this->Keys = new Queue;
  }

  /// Keys
  function Keys($keys) {
    $this->Keys->Children($keys);
    return $this;
  }

  function GetKeys() : array {
    return $this->Keys->GetChildren();
  }

  /// Type
  function Type(string $string) {
    $this->Type = $string;
    return $this;
  }

  function GetType() : string {
    return $this->Type;
  }

  /// Modifiers
  function Modifiers($nodes) {
    $this->Modifiers->Children($nodes);
    return $this;
  }

  function GetModifiers() : array {
    return $this->Modifiers->GetChildren();
  }

  /// Generate
  function Generate() : string {
    $final = new Queue;
    $this->Keys->LeftPrefix($this->Type);
    foreach ($this->Modifiers->GetChildren() as $modifier) {
      $this->Keys->RightPrefix(
        !empty($modifier->GetName())
          ? ":".$modifier->GetName().", "
          : ", "
      );
      $strKeys = $this->Keys->Generate();
      if (strlen($strKeys) > 1)
        $strKeys = substr($strKeys, 0, -2);
      $final->Children([$strKeys.$modifier->Generate()]);
    }
    return $final->Generate();
  }
}