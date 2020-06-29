<?php

require_once(__DIR__ . "/Element.php");
require_once(__DIR__ . "/Tag.php");
require_once(__DIR__ . "/EmptyNode.php");

class Container extends Element
{
  private $Child;

  function __construct() {
    parent::__construct();
    $this->AddThemeKey("__ly_container");
    $this->Child = new EmptyNode;
  }

  /// Child
  function SetChild(Node $child) {
    $this->Child = $child;
    return $this;
  }

  function GetChild() : Node {
    return $this->Child;
  }

  /// Generate
  function Generate() : string {
    return (new Tag)
    ->SetName("div")
    ->AddArguments($this->GetArguments()->GetChilds())
    ->SetChild($this->Child)
    ->Generate();
  }
}