<?php

require_once(__DIR__ . "/Field.php");

class TextBox extends Field
{
  function __construct() {
    parent::__construct();
  }

  function Generate() : string {
    return Tag::Create()
    ->Name("textarea")
    ->Arguments($this->GetArguments()->GetChildren())
    ->Child(
      !empty($this->GetText())
        ? $this->GetText()
        : " "
    )
    ->Generate();
  }
}