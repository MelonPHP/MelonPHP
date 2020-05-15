<?php

require_once(__DIR__ . "/../Includes/Html.php");
require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/ActionItem.php");

class CheckBox extends ActionItem
{
  private $Child = "";
  private $Checked = false;

  function __construct() {
    parent::__construct();
    $this->Type = "checkbox";
  }

  function SetValue(string $text) {
    $this->Value = $text;
    return $this;
  }

  function GetValue() : string {
    return $this->Value;
  }

  function SetChecked(bool $bool) {
    $this->Checked = $bool;
    return $this;
  }

  function GetChecked() : string {
    return $this->Checked;
  }

  function SetChild(GeneratedObject $child) {
    $this->Child = $child;
    return $this;
  }

  function GetChild() : GeneratedObject {
    return $this->Child;
  }

  function GetArguments(): array {
    $args = parent::GetArguments();
    if ($this->Checked)
      array_push($args,
        (new Argument)
        ->SetName("checked")
        ->AddItem("")
      );
    return $args;
  }

  function Generate() : string {
    return (new Tag)
    ->SetName("input")
    ->AddArguments($this->GetArguments())
    ->SetChild($this->Child)
    ->Generate();
  }
}