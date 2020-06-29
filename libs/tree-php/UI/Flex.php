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
     $this->ThemeKeys(["__layout_queue"]);
     $this->Childs = Queue::Create();
  }

  // Childs
  function Children($childs) {
    $this->Childs->Children($childs);
    return $this;
  }

  function GetChildren() : array {
    return $this->Childs->GetChildren();
  }

  /// MainAlign
  public function MainAlign(string $align) {
    $this->MainAlign = $align;
    return $this;
  }

  public function GetMainAlign() {
    return $this->MainAlign;
  }

  /// CrossAlign
  public function CrossAlign(string $align) {
    $this->CrossAlign = $align;
    return $this;
  }

  public function GetCrossAlign() {
    return $this->CrossAlign;
  }

  /// Generate
  // TODO: Refactor
  function GetArguments() : Queue {
    $args = parent::GetArguments()->GetChildren();
    foreach ($args as &$arg) {
      if ($arg->GetName() === "style") {
        $arg->Value(
          $arg->GetValue()
          ." ".(new ThemeParameter)
          ->Name(JustifyContent)
          ->Value($this->MainAlign)
          ->Generate().";"
          ." ".(new ThemeParameter)
          ->Name(AlignItems)
          ->Value($this->CrossAlign)
          ->Generate().";"
        );
        break;
      }
    } 
    return Queue::Create()
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