<?php

require_once(__DIR__ . "/Element.php");
require_once(__DIR__ . "/Tag.php");
require_once(__DIR__ . "/EmptyNode.php");

class Container extends Element
{
  private $Child;

  function __construct() {
    parent::__construct();
    $this->ThemeKeys(["__ly_container"]);
    $this->Child = EmptyNode::Create();
  }

  /// Child
  function Child(Node $child) {
    $this->Child = $child;
    return $this;
  }

  function GetChild() : Node {
    return $this->Child;
  }

  /// Generate
  function Generate() : string {
    return (new Tag)
    ->Name("div")
    ->Arguments($this->GetArguments()->GetChildren())
    ->Child($this->Child)
    ->Generate();
  }
}