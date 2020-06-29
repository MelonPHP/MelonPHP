<?php

require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/ActionNode.php");

abstract class Field extends ActionNode
{
  private $Placeholder = "";

  function __construct() {
    parent::__construct();
    $this->ThemeKeys(["__text"]);
    $this->ThemeKeys(["__field"]);
    $this->ThemeKeys(["__text_cursor"]);
  }

  function Text(string $text) {
    $this->Value = $text;
    return $this;
  }

  function GetText() : string {
    return $this->Value;
  }

  function Placeholder(string $text) {
    $this->Placeholder = $text;
    return $this;
  }

  function GetPlaceholder() : string {
    return $this->Placeholder;
  }

  /// Generate
  function GetArguments() : Queue {
    $args = parent::GetArguments();
    if (!empty($this->Type))
      $args->Children([
        Argument::Create()
        ->Name("placeholder")
        ->Value($this->Placeholder)
      ]);
    return $args;
  }

  function Generate() : string {
    return Tag::Create()
    ->Name("input")
    ->Arguments($this->GetArguments()->GetChildren())
    ->Generate();
  }
}