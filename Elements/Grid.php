<?php

require_once(__DIR__ . "/../Includes/Html.php");
require_once(__DIR__ . "/../Includes/Core.php");

class Grid extends Element
{
  private $Childs;
  private $ColumnTeample = "";
  private $Spacing;

  function __construct() {
     parent::__construct();
     $this->AddThemeKey("__ly_grid");
     $this->Childs = new Queue;
     $this->Spacing = Px(0);
  }

  function SetSpacing(string $spacing) {
    $this->Spacing = $spacing;
    return $this;
  }

  function GetSpacing() : string {
    return $this->Spacing;
  }

  function SetColumnTeample(string $spacing) {
    $this->ColumnTeample = $spacing;
    return $this;
  }

  function GetColumnTeample() : string {
    return $this->ColumnTeample;
  }

  function AddChild(GeneratedObject $child) {
    $this->Childs->AddChild($child);
    return $this;
  }

  function GetChilds() : array {
    return $this->Childs->GetChilds();
  }

  function GetArguments() : array {
    $args = parent::GetArguments();
    foreach ($args as &$arg) {
      if ($arg->GetName() === "style") {
        $arg->AddItem(GridGap, $this->Spacing);
        $arg->AddItem(GridTemplateColumns, $this->ColumnTeample);
        break;
      }
    } 
    return $args;
  }

  function Generate() : string {
    return (new Tag)
    ->SetName("div")
    ->AddArguments($this->GetArguments())
    ->SetChild($this->Childs)
    ->Generate();
  }
}