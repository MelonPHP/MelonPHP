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
     $this->AddThemeKey("__ly_grid");
     $this->Childs = new Queue;
     $this->Spacing = Px(0);
  }

  /// Spacing
  function SetSpacing(string $spacing) {
    $this->Spacing = $spacing;
    return $this;
  }

  function GetSpacing() : string {
    return $this->Spacing;
  }

  /// ColumnTeample
  function SetColumnTeample(string $spacing) {
    $this->ColumnTeample = $spacing;
    return $this;
  }

  function GetColumnTeample() : string {
    return $this->ColumnTeample;
  }

  /// Childs
  function SetChilds(array $childs) {
    $this->Childs->SetChilds($childs);
    return $this;
  }

  function AddChilds(array $childs) {
    $this->Childs->AddChilds($childs);
    return $this;
  }

  function AddChild(Node $child) {
    $this->Childs->AddChild($child);
    return $this;
  }

  function GetChilds() : array {
    return $this->Childs->GetChilds();
  }

  /// Generate
  function GetArguments() : Queue {
    $args = parent::GetArguments()->GetChilds();
    foreach ($args as &$arg) {
      if ($arg->GetName() === "style") {
        $totalQ = (new Queue)
        ->SetLeftPrefix(" ")
        ->SetRightPrefix(";");
        if (!empty($this->Spacing))
          $totalQ->AddChild(
            (new ThemeParameter)
            ->SetName(GridGap)
            ->SetValue($this->Spacing)
            ->Generate()
          );
        if (!empty($this->ColumnTeample))
          $totalQ->AddChild(
            (new ThemeParameter)
            ->SetName(GridTemplateColumns)
            ->SetValue($this->ColumnTeample)
            ->Generate()
          );
        $arg->SetValue(
          $arg->GetValue()
          .$totalQ->Generate()
        );
        break;
      }
    } 
    return (new Queue)
    ->SetChilds($args);
  }

  function Generate() : string {
    return (new Tag)
    ->SetName("div")
    ->AddArguments($this->GetArguments()->GetChilds())
    ->SetChild($this->Childs)
    ->Generate();
  }
}