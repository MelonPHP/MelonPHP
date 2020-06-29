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
    $this->ThemeKeys(["__text"]);
    $this->ThemeKeys(["__hover_cursor"]);
    $this->ThemeKeys(["__text_no_select"]);
  }

  /// Child
  public function Child($nodeOrString) {
    $this->Child = $nodeOrString;
    return $this;
  }

  public function GetChild() /* node or string */ {
    return $this->Child;
  }

  /// Link
  public function Link(string $string) {
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
      $args->Children([
        Argument::Create()
        ->Name("href")
        ->Value($this->Link)
      ]);
    return $args;
  }

  function Generate() : string {
    return Tag::Create()
    ->Arguments($this->GetArguments()->GetChildren())
    ->Name("a")
    ->Child($this->Child)
    ->Generate();
  }
}