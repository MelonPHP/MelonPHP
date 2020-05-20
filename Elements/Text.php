<?php

require_once(__DIR__ . "/../Includes/Html.php");

class Text extends Element
{
  private $Text;

  function __construct() {
    parent::__construct();
    $this->AddThemeKey("__text");
  }

  public function SetText(string $string) {
    $this->Text = $string;
    return $this;
  }

  public function GetText() : string {
    return $this->Text;
  }

  function Generate() : string {
    return (new Tag)
    ->AddArguments($this->GetArguments())
    ->SetName("p")
    ->SetChild($this->Text)
    ->Generate();
  }
}