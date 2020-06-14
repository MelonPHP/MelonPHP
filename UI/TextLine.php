<?php

require_once(__DIR__ . "/Element.php");
require_once(__DIR__ . "/Tag.php");

class TextLine extends Element
{
  function Generate() : string {
    return (new Tag)
    ->AddArguments($this->GetArguments()->GetChilds())
    ->SetName("br")
    ->Generate();
  }
}