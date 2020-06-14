<?php

require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/Element.php");
require_once(__DIR__ . "/Tag.php");

class Position extends Element
{
  private $Left = "";
  private $Right = "";
  private $Top = "";
  private $Bottom = "";

  private $Child =  " ";

  /// Child
  function SetChild(Node $child) {
    $this->Child = $child;
    return $this;
  }

  function GetChild() : Node {
    return $this->Child;
  }

  /// Left
  function SetLeft(string $string) {
    $this->Left = $string;
    return $this;
  }

  function GetLeft(string $string) {
    return $this->Left;
  }

  /// Right
  function SetRight(string $string) {
    $this->Right = $string;
    return $this;
  }

  function GetRight(string $string) {
    return $this->Right;
  }

  /// Top
  function SetTop(string $string) {
    $this->Top = $string;
    return $this;
  }

  function GetTop(string $string) {
    return $this->Top;
  }

  /// Bottom
  function SetBottom(string $string) {
    $this->Bottom = $string;
    return $this;
  }

  function GetBottom(string $string) {
    return $this->Bottom;
  }

  /// Generate
  // TODO: Refactor
  function GetArguments() : Queue {
    $args = parent::GetArguments()->GetChilds();
    foreach ($args as &$arg) {
      if ($arg->GetName() === "style") {
        if (!empty($this->Left))
          $arg->SetValue(
            $arg->GetValue()
            ." ".(new ThemeParameter)
            ->SetName(Left)
            ->SetValue($this->Left)
            ->Generate().";"
          );
        if (!empty($this->Right))
          $arg->SetValue(
            $arg->GetValue()
            ." ".(new ThemeParameter)
            ->SetName(Right)
            ->SetValue($this->Right)
            ->Generate().";"
          );
        if (!empty($this->Top))
          $arg->SetValue(
            $arg->GetValue()
            ." ".(new ThemeParameter)
            ->SetName(Top)
            ->SetValue($this->Top)
            ->Generate().";"
          );
        if (!empty($this->Bottom))
          $arg->SetValue(
            $arg->GetValue()
            ." ".(new ThemeParameter)
            ->SetName(Bottom)
            ->SetValue($this->Bottom)
            ->Generate().";"
          );
        break;
      }
    } 
    return (new Queue)
    ->SetChilds($args);
  }

  function Generate(): string {
    return (new Tag)
    ->SetName("div")
    ->AddArguments($this->GetArguments()->GetChilds())
    ->SetChild($this->Child)
    ->Generate();
  }
}