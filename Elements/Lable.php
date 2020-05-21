<?php

require_once(__DIR__ . "/../Includes/Html.php");
require_once(__DIR__ . "/Container.php");

class Lable extends Container
{
  private $For;

  function __construct() {
    parent::__construct();
  }

  public function SetFor(string $string) {
    $this->For = $string;
    return $this;
  }

  public function GetFor() : string {
    return $this->For;
  }

  function GetArguments(): array {
    $args = parent::GetArguments();
    if (isset($this->For))
      array_push($args,
        (new Argument)
        ->SetName("for")
        ->AddItem($this->For)
      );
    return $args;
  }

  function Generate() : string {
    return (new Tag)
    ->AddArguments($this->GetArguments())
    ->SetName("label")
    ->SetChild($this->Child)
    ->Generate();
  }
}