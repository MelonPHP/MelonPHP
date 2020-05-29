<?php

require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/ActionNode.php");
require_once(__DIR__ . "/ButtonTypes.php");

class Button extends ActionNode
{
  function __construct() {
    parent::__construct();

    $this->AddThemeKey("__text");
    $this->AddThemeKey("__button");
    $this->AddThemeKey("__hover_cursor");

    $this->SetType(ButtonTypes::Send);
  }

  /// Text
  function SetText(string $text) {
    $this->Value = $text;
    return $this;
  }

  function GetText() : string {
    return $this->Value;
  }

  /// Type
  function SetType(string $string) {
    if ($string === ButtonTypes::Send || $string === ButtonTypes::Clear)
      $this->Type = $string;
    return $this;
  }

  function GetType() : string {
    return $this->Type;
  }

  /// Generate
  function Generate() : string {
    return (new Tag)
    ->SetName("input")
    ->AddArguments($this->GetArguments()->GetChilds())
    ->Generate();
  }
}