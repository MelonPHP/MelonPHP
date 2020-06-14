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
    $this->AddThemeKey("__ly_container");
    $this->AddThemeKey("__ly_stack");
    $this->Childs = (new Queue);
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

  // Generator
  function GenerateChilds() : string {
    $childs = $this->Childs->GetChilds();
    foreach ($childs as &$child) {
      if (!($child instanceof Element)) {
        $child = (new Container)
        ->SetChild($child);
      }
      $child->AddThemeKey("__ly_stack_item");
    }
    return (new Queue)
    ->SetChilds($childs)
    ->Generate();
  }

  function Generate(): string {
    return (new Tag)
    ->SetName("div")
    ->SetArguments($this->GetArguments()->GetChilds())
    ->SetChild($this->GenerateChilds())
    ->Generate();
  }
}