<?php

require_once(__DIR__ . "/../Includes/Html.php");
require_once(__DIR__ . "/../Includes/Core.php");

abstract class ActionItem extends Element
{
  protected $Type = "";
  protected $Value = "";
  private $ActionKey = "";

  function SetActionKey(string $string) {
    $this->ActionKey = $string;
    return $this;
  }

  function GetArguments(): array {
    $args = parent::GetArguments();
    array_push($args, 
      (new Argument)
      ->SetName("type")
      ->AddItem($this->Type)
    );
    if ($this->ActionKey != "")
      array_push($args, 
        (new Argument)
        ->SetName("name")
        ->AddItem($this->ActionKey)
      );
    if ($this->Value != "")
      array_push($args, 
        (new Argument)
        ->SetName("value")
        ->AddItem($this->Value)
      );
    return $args;
  }

  function GetActionKey() : string{
    return $this->ActionKey;
  }
}