<?php

require_once(__DIR__ . "/Element.php");
require_once(__DIR__ . "/Tag.php");

class TextLine extends Element
{
  function Generate() : string {
    return Tag::Create()
    ->Arguments($this->GetArguments()->GetChildren())
    ->Name("br")
    ->Generate();
  }
}