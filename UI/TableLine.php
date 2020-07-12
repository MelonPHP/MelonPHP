<?php

require_once(__DIR__ . "/Element.php");
require_once(__DIR__ . "/Tag.php");
require_once(__DIR__ . "/TableCell.php");
require_once(__DIR__ . "/../Includes/Core.php");

class TableLine extends Element
{
  private $Cells;

  function __construct() {
    parent::__construct();
    $this->Cells = new Queue;
  }

  function Children($value) {
    if (is_array($value)) {
      $cells = new Queue;
      foreach ($value as &$node) {
        if (!is_a($node, "TableCell"))
          $node = TableCell::Create()->Child($node);
      }
    }
    else {
      if (!is_a($value, "TableCell"))
        $value = TableCell::Create()->Child($value);
    }
    $this->Cells->Children($value);
    return $this;
  }

  function GetChildren() : array {
    return $this->Cells->GetChildren();
  }

  function Generate() : string {
    return Tag::Create()
    ->Name("tr")
    ->Arguments($this->GetArguments()->GetChildren())
    ->Child($this->Cells->Generate())
    ->Generate();
  }
}