<?php

require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/ActionNode.php");

abstract class Field extends ActionNode
{
  private $Placeholder = "";

  function __construct() {
    parent::__construct();
    $this->AddThemeKey("__text");
    $this->AddThemeKey("__field");
    $this->AddThemeKey("__text_cursor");
  }

  function SetText(string $text) {
    $this->Value = $text;
    return $this;
  }

  function GetText() : string {
    return $this->Value;
  }

  function SetPlaceholder(string $text) {
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
      $args->AddChild(
        (new Argument)
        ->SetName("placeholder")
        ->SetValue($this->Placeholder)
      );
    return $args;
  }

  function Generate() : string {
    return (new Tag)
    ->SetName("input")
    ->AddArguments($this->GetArguments()->GetChilds())
    ->Generate();
  }
}