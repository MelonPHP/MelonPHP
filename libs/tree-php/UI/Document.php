<?php

require_once(__DIR__ . "/Element.php");
require_once(__DIR__ . "/Tag.php");
require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/../Includes/Styles.php");

class Document extends Element
{
  private $Child = " ";
  private $Themes;
  private $Title = " ";

  function __construct() {
    parent::__construct();
    $this->Themes = Queue::Create()
    ->LeftPrefix(" ")
    ->Children([
      GetStandartTheme(),
      GetElementsTheme()
    ]);
  }

  /// Child
  function Child(Node $child) {
    $this->Child = $child;
    return $this;
  }

  function GetChild() : Node {
    return $this->Child;
  }

  /// Theme
  function Themes($themes) {
    $this->Themes->Children($themes);
    return $this;
  }

  function GetThemes() : array {
    return $this->Themes->GetChildren();
  }

  /// Title
  function Title(string $string) {
    $this->Title = $string;
    return $this;
  }

  function GetTitle() {
    return $this->Title;
  }

  /// Generate
  function Generate() : string {
    return "<!DOCTYPE html>".Tag::Create()
    ->Name("html")
    ->Child(
      Queue::Create()
      ->Children([ 
        Tag::Create()
        ->Name("head")
        ->Child(
          Queue::Create()
          ->Children([
            Tag::Create()
            ->Name("title")
            ->Child($this->Title),
            Tag::Create()
            ->Name("style")
            ->Child($this->Themes),
            Tag::Create()
            ->Name("meta")
            ->Arguments([
              (new Argument)
              ->Name("name")
              ->Value("viewport"),
              (new Argument)
              ->Name("content")
              ->Value(CommaLine([
                "width=device-width", 
                "initial-scale=1", 
                "user-scalable=no"
              ]))
            ])
          ])
        ),
        Tag::Create()
        ->Name("body")
        ->Arguments($this->GetArguments()->GetChildren())
        ->Child($this->Child)
      ])
    )->Generate();
  }
}