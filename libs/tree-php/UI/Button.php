<?php

require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/ActionNode.php");
require_once(__DIR__ . "/ButtonTypes.php");

class Button extends ActionNode
{
  function __construct() {
    parent::__construct();

    $this->ThemeKeys(["__text", "__button", "__hover_cursor"]);

    $this->Type(ButtonTypes::Send);
  }

  /// Text
  function Text(string $text) {
    $this->Value = $text;
    return $this;
  }

  function GetText() : string {
    return $this->Value;
  }

  /// Type
  function Type(string $string) {
    if ($string === ButtonTypes::Send || $string === ButtonTypes::Clear)
      $this->Type = $string;
    return $this;
  }

  function GetType() : string {
    return $this->Type;
  }

  /// Generate
  function Generate() : string {
    return Tag::Create()
    ->Name("input")
    ->Arguments($this->GetArguments()->GetChildren())
    ->Generate();
  }
}