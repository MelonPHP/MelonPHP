<?php

require_once(__DIR__ . "/Element.php");
require_once(__DIR__ . "/Tag.php");
require_once(__DIR__ . "/../Includes/Core.php");

class Table extends Element
{
  private $Lines;

  function __construct() {
    parent::__construct();
    $this->Lines = new Queue;
  }

  function Lines($value) {
    $this->Lines->Children($value);
    return $this;
  }

  function GetLines() : array {
    return $this->Lines->GetChildren();
  }

  function Generate() : string {
    return Tag::Create()
    ->Name("table")
    ->Arguments($this->GetArguments()->GetChildren())
    ->Child($this->Lines->Generate())
    ->Generate();
  }
}