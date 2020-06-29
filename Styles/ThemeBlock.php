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
    ->SetLeftPrefix(" ");
    $this->Keys = (new Queue);
  }

  /// Keys
  function SetKeys(array $keys) {
    $this->Keys->SetChilds($keys);
    return $this;
  }

  function SetKey(string $key) {
    $this->Keys->SetChilds([$key]);
    return $this;
  }

  function GetKeys() : array {
    return $this->Keys->GetChilds();
  }

  /// Type
  function SetType(string $string) {
    $this->Type = $string;
    return $this;
  }

  function GetType() : string {
    return $this->Type;
  }

  /// Modifiers
  function SetModifiers(array $nodes) {
    $this->Modifiers->SetChilds($nodes);
    return $this;
  }

  function AddModifiers(array $nodes) {
    $this->Modifiers->AddChilds($nodes);
    return $this;
  }

  function AddModifier(Modifier $node) {
    $this->Modifiers->AddChild($node);
    return $this;
  }

  function GetModifiers() : array {
    return $this->Modifiers->GetChilds();
  }

  /// Generate
  function Generate() : string {
    $final = (new Queue);
    $this->Keys->SetLeftPrefix($this->Type);
    foreach ($this->Modifiers->GetChilds() as $modifier) {
      $this->Keys->SetRightPrefix(
        !empty($modifier->GetName())
          ? ":".$modifier->GetName().", "
          : ", "
      );
      $strKeys = $this->Keys->Generate();
      if (strlen($strKeys) > 1)
        $strKeys = substr($strKeys, 0, -2);
      $final->AddChild($strKeys.$modifier->Generate());
    }
    return $final->Generate();
  }
}