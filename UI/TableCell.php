<?php

require_once(__DIR__ . "/Element.php");
require_once(__DIR__ . "/Tag.php");
require_once(__DIR__ . "/../Includes/Core.php");

class TableCell extends Element
{
  private $Child;

  function Child($value) {
    if (is_string($value))
      $value = Text::Create()->Text($value);
    $this->Child = $value;
    return $this;
  }

  function GetChild() : Node {
    return $this->Child;
  }

  function Generate() : string {
    return Tag::Create()
    ->Name("td")
    ->Arguments($this->GetArguments()->GetChildren())
    ->Child($this->Child->Generate())
    ->Generate();
  }
}