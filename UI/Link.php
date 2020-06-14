<?php

require_once(__DIR__ . "/Element.php");
require_once(__DIR__ . "/Tag.php");
require_once(__DIR__ . "/Argument.php");

class Link extends Element
{
  private $Child = "";
  private $Link = "";

  function __construct() {
    parent::__construct();
    $this->AddThemeKey("__text");
    $this->AddThemeKey("__hover_cursor");
    $this->AddThemeKey("__text_no_select");
  }

  /// Child
  public function SetChild($nodeOrString) {
    $this->Child = $nodeOrString;
    return $this;
  }

  public function GetChild() /* node or string */ {
    return $this->Child;
  }

  /// Link
  public function SetLink(string $string) {
    $this->Link = $string;
    return $this;
  }

  public function GetLink() : string {
    return $this->Link;
  }

  /// Generate
  function GetArguments() : Queue {
    $args = parent::GetArguments();
    if (!empty($this->Link))
      $args->AddChild(
        (new Argument)
        ->SetName("href")
        ->SetValue($this->Link)
      );
    return $args;
  }

  function Generate() : string {
    return (new Tag)
    ->AddArguments($this->GetArguments()->GetChilds())
    ->SetName("a")
    ->SetChild($this->Child)
    ->Generate();
  }
}