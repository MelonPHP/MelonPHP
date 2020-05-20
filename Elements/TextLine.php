<?php

require_once(__DIR__ . "/../Includes/Html.php");

class TextLine extends Element
{
  function Generate() : string {
    return (new Tag)
    ->AddArguments($this->GetArguments())
    ->SetName("br")
    ->Generate();
  }
}