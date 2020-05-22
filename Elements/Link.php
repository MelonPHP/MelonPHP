<?php

require_once(__DIR__ . "/../Includes/Html.php");

class Link extends Element
{
  private $Text;
  private $Link;

  function __construct() {
    parent::__construct();
    $this->AddThemeKey("__text");
    $this->AddThemeKey("__hover_cursor");
  }

  public function SetText(string $string) {
    $this->Text = $string;
    return $this;
  }

  public function GetText() : string {
    return $this->Text;
  }

  public function SetLink(string $string) {
    $this->Link = $string;
    return $this;
  }

  public function GetLink() : string {
    return $this->Link;
  }

  function GetArguments(): array {
    $args = parent::GetArguments();
    if (isset($this->Link))
      array_push($args,
        (new Argument)
        ->SetName("href")
        ->AddItem($this->Link)
      );
    return $args;
  }

  function Generate() : string {
    return (new Tag)
    ->AddArguments($this->GetArguments())
    ->SetName("a")
    ->SetChild($this->Text)
    ->Generate();
  }
}