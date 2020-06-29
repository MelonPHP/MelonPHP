<?php

require_once(__DIR__ . "/Field.php");

class TextBox extends Field
{
  function __construct() {
    parent::__construct();
  }

  function Generate() : string {
    return (new Tag)
    ->SetName("textarea")
    ->AddArguments($this->GetArguments()->GetChilds())
    ->SetChild(
      !empty($this->GetText())
        ? $this->GetText()
        : " "
    )
    ->Generate();
  }
}