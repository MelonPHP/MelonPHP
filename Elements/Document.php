<?php

require_once(__DIR__ . "/../Includes/Html.php");
require_once(__DIR__ . "/../Includes/Css.php");
require_once(__DIR__ . "/../Includes/Core.php");

class Document extends Element
{
  private $Childs;
  private $Themes;
  private $Title = " ";

  function __construct() {
    parent::__construct();
    $this->Childs = new Queue;
    $this->Themes = new Queue;
    $this->Themes->AddChild(GetStandartTheme());
    $this->Themes->AddChild(GetElementsTheme());
  }

  function AddChild(GeneratedObject $child) {
    $this->Childs->AddChild($child);
    return $this;
  }

  function GetChilds() : array {
    return $this->Childs->GetChilds();
  }

  function AddTheme(Theme $child) {
    $this->Themes->AddChild($child);
    return $this;
  }

  function GetThemes() : array {
    return $this->Themes->GetChilds();
  }

  function SetTitle(string $string) {
    $this->Title = $string;
    return $this;
  }

  function GetTitle() {
    return $this->Title;
  }

  function Generate() : string {
    return "<!DOCTYPE html>".(new Tag)
    ->SetName("html")
    ->SetChild(
      (new Queue)
      ->AddChild(
        (new Tag)
        ->SetName("head")
        ->SetChild(
          (new Queue)
          ->AddChild(
            (new Tag)
            ->SetName("title")
            ->SetChild($this->Title)
          )
          ->AddChild(
            (new Tag)
            ->SetName("style")
            ->SetChild($this->Themes)
          )
        )
      )
      ->AddChild(
        (new Tag)
        ->SetName("body")
        ->AddArguments($this->GetArguments())
        ->SetChild($this->Childs)
      )
    )
    ->Generate();
  }
}