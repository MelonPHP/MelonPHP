<?php

require_once(__DIR__ . "/../Includes/Html.php");
require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/MainAxisAlign.php");
require_once(__DIR__ . "/CrossAxisAlign.php");

abstract class Flex extends Element
{
  private $MainAlign = MainAxisAlign::Start;
  private $CrossAlign = CrossAxisAlign::Start;
  private $Childs;

  function __construct() {
     parent::__construct();
     $this->AddThemeKey("__layout_queue");
     $this->Childs = new Queue;
  }

  function AddChild(GeneratedObject $child) {
    $this->Childs->AddChild($child);
    return $this;
  }

  function GetChilds() : array {
    return $this->Childs->GetChilds();
  }

  public function SetMainAlign(string $align) {
    $this->MainAlign = $align;
    return $this;
  }

  public function GetMainAlign() {
    return $this->MainAlign;
  }

  public function SetCrossAlign(string $align) {
    $this->CrossAlign = $align;
    return $this;
  }

  public function GetCrossAlign() {
    return $this->CrossAlign;
  }

  function GetArguments() : array {
    $args = parent::GetArguments();
    foreach ($args as &$arg) {
      if ($arg->GetName() === "style") {
        $arg->AddItem(
          (new ThemeParameter)
          ->SetName(JustifyContent)
          ->SetValue($this->MainAlign)
          ->Generate()
        );
        $arg->AddItem(
          (new ThemeParameter)
          ->SetName(AlignItems)
          ->SetValue($this->CrossAlign)
          ->Generate()
        );
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