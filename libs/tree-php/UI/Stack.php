<?php

require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/Element.php");
require_once(__DIR__ . "/Tag.php");

class Stack extends Element
{
  private $Childs;

  function __construct() {
    parent::__construct();
    //TODO: Add
    $this->ThemeKeys(["__ly_container"]);
    $this->ThemeKeys(["__ly_stack"]);
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

  // Generator
  function GenerateChilds() : string {
    $childs = $this->Childs->GetChildren();
    foreach ($childs as &$child) {
      if (!($child instanceof Element)) {
        $child = Container::Create()
        ->Child($child);
      }
      $child->ThemeKeys(["__ly_stack_item"]);
    }
    return Queue::Create()
    ->Children($childs)
    ->Generate();
  }

  function Generate(): string {
    return Tag::Create()
    ->Name("div")
    ->Arguments($this->GetArguments()->GetChildren())
    ->Child($this->GenerateChilds())
    ->Generate();
  }
}