<?php

require_once(__DIR__ . "/../Includes/Html.php");
require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/ActionItem.php");

class TextField extends ActionItem
{
  private $Placeholder = "";

  function __construct() {
    parent::__construct();
    $this->Type = "text";
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

  function GetArguments(): array {
    $args = parent::GetArguments();
    if ($this->Placeholder != "")
      array_push($args,
        (new Argument)
        ->SetName("placeholder")
        ->AddItem($this->Placeholder)
      );
    return $args;
  }

  function Generate() : string {
    return (new Tag)
    ->SetName("input")
    ->AddArguments($this->GetArguments())
    ->Generate();
  }
}