<?php

require_once(__DIR__ . "/../Includes/Html.php");
require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/ActionItem.php");

class ActionVarible extends ActionItem
{
  function __construct() {
    parent::__construct();
    $this->Type = "hidden";
  }

  function SetActionValue(string $string) {
    $this->Value = $string;
    return $this;
  }

  function GetActionValue() : string {
    return $this->Value;
  }

  function Generate() : string {
    return (new Tag)
    ->SetName("input")
    ->AddArguments($this->GetArguments())
    ->Generate();
  }
}