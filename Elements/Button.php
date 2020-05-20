<?php

require_once(__DIR__ . "/../Includes/Html.php");
require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/ActionItem.php");

class Button extends ActionItem
{
  const Send = "submit";
  const Clear = "reset";

  function __construct() {
    parent::__construct();
    $this->Type = Button::Send;
  }

  function SetText(string $text) {
    $this->Value = $text;
    return $this;
  }

  function GetText() : string {
    return $this->Value;
  }

  function SetType(string $string) {
    if ($string === Button::Send || $string === Button::Clear)
      $this->Type = $string;
    return $this;
  }

  function GetType() : string {
    return $this->Type;
  }

  function Generate() : string {
    return (new Tag)
    ->SetName("input")
    ->AddArguments($this->GetArguments())
    ->Generate();
  }
}