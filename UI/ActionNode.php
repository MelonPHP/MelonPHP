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
  function SetActionKey(string $string) {
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
      $args->AddChild(
        (new Argument)
        ->SetName("type")
        ->SetValue($this->Type)
      );
    if (!empty($this->ActionKey))
      $args->AddChild(
        (new Argument)
        ->SetName("name")
        ->SetValue($this->ActionKey)
      );
    if (!empty($this->Value))
      $args->AddChild(
        (new Argument)
        ->SetName("value")
        ->SetValue($this->Value)
      );
    return $args;
  }


}