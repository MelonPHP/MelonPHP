<?php

require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/Element.php");
require_once(__DIR__ . "/Argument.php");

abstract class ActionNode extends Element
{
  protected $Type = "";
  protected $Value = "";
  private $ActionKey = "";

  // ActionKey
  function ActionKey(string $string) {
    $this->ActionKey = $string;
    return $this;
  }

  function GetActionKey() : string{
    return $this->ActionKey;
  }

  /// Generate
  function GetArguments() : Queue {
    $args = parent::GetArguments();
    if (!empty($this->Type))
      $args->Children([
        Argument::Create()
        ->Name("type")
        ->Value($this->Type)
      ]);
    if (!empty($this->ActionKey))
      $args->Children([
        Argument::Create()
        ->Name("name")
        ->Value($this->ActionKey)
      ]);
    if (!empty($this->Value))
      $args->Children([
        Argument::Create()
        ->Name("value")
        ->Value($this->Value)
      ]);
    return $args;
  }


}