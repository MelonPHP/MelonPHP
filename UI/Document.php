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
    $this->Themes = (new Queue)
    ->SetLeftPrefix(" ")
    ->SetChilds([
      GetStandartTheme(),
      GetElementsTheme()
    ]);
  }

  /// Child
  function SetChild(Node $child) {
    $this->Child = $child;
    return $this;
  }

  function GetChild() : Node {
    return $this->Child;
  }

  /// Theme
  function SetThemes(array $themes) {
    $this->Themes->SetChilds($themes);
    return $this;
  }

  function AddThemes(array $themes) {
    $this->Themes->AddChilds($themes);
    return $this;
  }

  function AddTheme(Theme $theme) {
    $this->Themes->AddChild($theme);
    return $this;
  }

  function GetThemes() : array {
    return $this->Themes->GetChilds();
  }

  /// Title
  function SetTitle(string $string) {
    $this->Title = $string;
    return $this;
  }

  function GetTitle() {
    return $this->Title;
  }

  /// Generate
  function Generate() : string {
    return "<!DOCTYPE html>".(new Tag)
    ->SetName("html")
    ->SetChild(
      (new Queue)
      ->SetChilds([ 
        (new Tag)
        ->SetName("head")
        ->SetChild(
          (new Queue)
          ->SetChilds([
            (new Tag)
            ->SetName("title")
            ->SetChild($this->Title),
            (new Tag)
            ->SetName("style")
            ->SetChild($this->Themes),
            (new Tag)
            ->SetName("meta")
            ->AddArguments([
              (new Argument)
              ->SetName("name")
              ->SetValue("viewport"),
              (new Argument)
              ->SetName("content")
              ->SetValue(CommaLine([
                "width=device-width", 
                "initial-scale=1", 
                "user-scalable=no"
              ]))
            ])
          ])
        ),
        (new Tag)
        ->SetName("body")
        ->SetArguments($this->GetArguments()->GetChilds())
        ->SetChild($this->Child)
      ])
    )->Generate();
  }
}