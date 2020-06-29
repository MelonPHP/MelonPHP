<?php

require_once(__DIR__ . "/Element.php");
require_once(__DIR__ . "/Tag.php");

class Text extends Element
{
  private $Text = "";

  function __construct() {
    parent::__construct();
    $this->ThemeKeys(["__text"]);
    $this->ThemeKeys(["__text_no_select"]);
  }

  /// Text
  public function Text(string $string) {
    $this->Text = $string;
    return $this;
  }

  public function GetText() : string {
    return $this->Text;
  }

  /// Generate
  function Generate() : string {
    return (new Tag)
    ->Arguments($this->GetArguments()->GetChildren())
    ->Name("p")
    ->Child($this->Text)
    ->Generate();
  }
}