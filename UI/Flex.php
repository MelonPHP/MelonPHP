<?php

require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/Element.php");
require_once(__DIR__ . "/MainAxisAligns.php");
require_once(__DIR__ . "/CrossAxisAligns.php");

abstract class Flex extends Element
{
  private $MainAlign = MainAxisAligns::Start;
  private $CrossAlign = CrossAxisAligns::Start;
  private $Childs;

  function __construct() {
     parent::__construct();
     $this->AddThemeKey("__layout_queue");
     $this->Childs = new Queue;
  }

  // Childs
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

  /// MainAlign
  public function SetMainAlign(string $align) {
    $this->MainAlign = $align;
    return $this;
  }

  public function GetMainAlign() {
    return $this->MainAlign;
  }

  /// CrossAlign
  public function SetCrossAlign(string $align) {
    $this->CrossAlign = $align;
    return $this;
  }

  public function GetCrossAlign() {
    return $this->CrossAlign;
  }

  /// Generate
  // TODO: Refactor
  function GetArguments() : Queue {
    $args = parent::GetArguments()->GetChilds();
    foreach ($args as &$arg) {
      if ($arg->GetName() === "style") {
        $arg->SetValue(
          $arg->GetValue()
          ." ".(new ThemeParameter)
          ->SetName(JustifyContent)
          ->SetValue($this->MainAlign)
          ->Generate().";"
          ." ".(new ThemeParameter)
          ->SetName(AlignItems)
          ->SetValue($this->CrossAlign)
          ->Generate().";"
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