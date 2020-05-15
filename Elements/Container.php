<?php

require_once(__DIR__ . "/../Includes/Html.php");
require_once(__DIR__ . "/../Includes/Core.php");

class Container extends Element
{
  private $Child = "";

  function __construct() {
    parent::__construct();
    $this->AddThemeKey("__ly_container");
  }

  function SetChild(GeneratedObject $child) {
    $this->Child = $child;
    return $this;
  }

  function GetChild() : GeneratedObject {
    return $this->Child;
  }

  function Generate() : string {
    return (new Tag)
    ->SetName("div")
    ->AddArguments($this->GetArguments())
    ->SetChild($this->Child)
    ->Generate();
  }
}