<?php

require_once(__DIR__ . "/../Includes/Html.php");
require_once(__DIR__ . "/../Includes/Core.php");

class Action extends Element
{
  const Post = "POST";
  const Get = "GET";
  const Update = "UPDATE";
  const Delete = "DELETE";

  private $Redirect = "";
  private $Type = Action::Get;
  private $Child = " ";

  function SetChild(GeneratedObject $child) {
    $this->Child = $child;
    return $this;
  }

  function GetChild() : GeneratedObject {
    return $this->Child;
  }

  function SetType(string $type) {
    $this->Type = $type;
    return $this;
  }

  function GetType() : string {
    return $this->Type;
  }

  function SetRedirect(string $uri) {
    $this->Redirect = $uri;
    return $this;
  }

  function GetRedirect() : string {
    return $this->Redirect;
  }

  function GetArguments(): array {
    $args = parent::GetArguments();
    if ($this->Redirect != "")
      array_push($args, 
        (new Argument)
        ->SetName("action")
        ->AddItem($this->Redirect)
      );
    if ($this->Type != "")
      array_push($args, 
        (new Argument)
        ->SetName("method")
        ->AddItem($this->Type)
      );
    return $args;
  }

  function Generate() : string {
    return (new Tag)
    ->SetName("form")
    ->AddArguments($this->GetArguments())
    ->SetChild($this->Child)
    ->Generate();
  }
}