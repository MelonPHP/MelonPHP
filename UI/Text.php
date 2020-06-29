<?php

require_once(__DIR__ . "/Element.php");
require_once(__DIR__ . "/Tag.php");

class Text extends Element
{
  private $Text = "";

  function __construct() {
    parent::__construct();
    $this->AddThemeKey("__text");
    $this->AddThemeKey("__text_no_select");
  }

  /// Text
  public function SetText(string $string) {
    $this->Text = $string;
    return $this;
  }

  public function GetText() : string {
    return $this->Text;
  }

  /// Generate
  function Generate() : string {
    return (new Tag)
    ->SetArguments($this->GetArguments()->GetChilds())
    ->SetName("p")
    ->SetChild($this->Text)
    ->Generate();
  }
}