<?php

require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/Element.php");
require_once(__DIR__ . "/Tag.php");

class Grid extends Element
{
  private $Childs;
  private $ColumnTeample = "";
  private $Spacing = "";

  function __construct() {
     parent::__construct();
     $this->ThemeKeys(["__ly_grid"]);
     $this->Childs = new Queue;
     $this->Spacing = Px(0);
  }

  /// Spacing
  function Spacing(string $spacing) {
    $this->Spacing = $spacing;
    return $this;
  }

  function GetSpacing() : string {
    return $this->Spacing;
  }

  /// ColumnTeample
  function ColumnTeample(string $spacing) {
    $this->ColumnTeample = $spacing;
    return $this;
  }

  function GetColumnTeample() : string {
    return $this->ColumnTeample;
  }

  /// Childs
  function Children($childs) {
    $this->Childs->Children($childs);
    return $this;
  }

  function GetChilds() : array {
    return $this->Childs->GetChildren();
  }

  /// Generate
  function GetArguments() : Queue {
    $args = parent::GetArguments()->GetChildren();
    foreach ($args as &$arg) {
      if ($arg->GetName() === "style") {
        $totalQ = Queue::Create()
        ->LeftPrefix(" ")
        ->RightPrefix(";");
        if (!empty($this->Spacing))
          $totalQ->Children([
            (new ThemeParameter)
            ->Name(GridGap)
            ->Value($this->Spacing)
            ->Generate()
          ]);
        if (!empty($this->ColumnTeample))
          $totalQ->Children([
            (new ThemeParameter)
            ->Name(GridTemplateColumns)
            ->Value($this->ColumnTeample)
            ->Generate()
          ]);
        $arg->Value(
          $arg->GetValue()
          .$totalQ->Generate()
        );
        break;
      }
    } 
    return (new Queue)
    ->Children($args);
  }

  function Generate() : string {
    return Tag::Create()
    ->Name("div")
    ->Arguments($this->GetArguments()->GetChildren())
    ->Child($this->Childs)
    ->Generate();
  }
}