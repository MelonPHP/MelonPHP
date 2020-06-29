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
  function Child(Node $child) {
    $this->Child = $child;
    return $this;
  }

  function GetChild() : Node {
    return $this->Child;
  }

  /// Left
  function Left(string $string) {
    $this->Left = $string;
    return $this;
  }

  function GetLeft(string $string) {
    return $this->Left;
  }

  /// Right
  function Right(string $string) {
    $this->Right = $string;
    return $this;
  }

  function GetRight(string $string) {
    return $this->Right;
  }

  /// Top
  function Top(string $string) {
    $this->Top = $string;
    return $this;
  }

  function GetTop(string $string) {
    return $this->Top;
  }

  /// Bottom
  function Bottom(string $string) {
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
          $arg->Value(
            $arg->GetValue()
            ." ".(new ThemeParameter)
            ->Name(Left)
            ->Value($this->Left)
            ->Generate().";"
          );
        if (!empty($this->Right))
          $arg->Value(
            $arg->GetValue()
            ." ".(new ThemeParameter)
            ->Name(Right)
            ->Value($this->Right)
            ->Generate().";"
          );
        if (!empty($this->Top))
          $arg->Value(
            $arg->GetValue()
            ." ".(new ThemeParameter)
            ->Name(Top)
            ->Value($this->Top)
            ->Generate().";"
          );
        if (!empty($this->Bottom))
          $arg->Value(
            $arg->GetValue()
            ." ".(new ThemeParameter)
            ->Name(Bottom)
            ->Value($this->Bottom)
            ->Generate().";"
          );
        break;
      }
    } 
    return Queue::Create()
    ->Children($args);
  }

  function Generate(): string {
    return Tag::Create()
    ->Name("div")
    ->Arguments($this->GetArguments()->GetChildren())
    ->Child($this->Chsild)
    ->Generate();
  }
}