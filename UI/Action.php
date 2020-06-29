<?php

require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/Container.php");
require_once(__DIR__ . "/Argument.php");
require_once(__DIR__ . "/Tag.php");
require_once(__DIR__ . "/ActionTypes.php");
require_once(__DIR__ . "/ActionVarible.php");

class Action extends Container
{
  private $Redirect = "";
  private $Varibles;
  private $Type;
  
  function __construct() {
    parent::__construct();

    $this->Varibles = new Queue;

    $this->SetType(ActionTypes::Get);
  }

  /// Varibles
  function SetVaribles(array $varibles) {
    $this->Varibles->SetChilds($varibles);
    return $this;
  }

  function AddVaribles(array $varibles) {
    $this->Varibles->AddChilds($varibles);
    return $this;
  }

  function AddVarible(ActionVarible $varible) {
    $this->Varibles->AddChild($varible);
    return $this;
  }

  function GetVaribles() : array {
    return $this->Varibles->GetChilds();
  }

  /// Type
  function SetType(string $type) {
    $this->Type = $type;
    return $this;
  }

  function GetType() : string {
    return $this->Type;
  }

  /// Redirect
  function SetRedirect(string $uri) {
    $this->Redirect = $uri;
    return $this;
  }

  function GetRedirect() : string {
    return $this->Redirect;
  }

  /// Generate
  function GetArguments() : Queue {
    $args = parent::GetArguments();
    if (!empty($this->Redirect))
      $args->AddChild(
        (new Argument)
        ->SetName("action")
        ->SetValue($this->Redirect)
      );
    if (!empty($this->Type))
      $args->AddChild(
        (new Argument)
        ->SetName("method")
        ->SetValue($this->Type)
      );
    return $args;
  }

  function Generate() : string {
    return (new Tag)
    ->SetName("form")
    ->AddArguments($this->GetArguments()->GetChilds())
    ->SetChild(
      (new Queue)
      ->AddChild($this->GetChild())
      ->AddChilds($this->GetVaribles())
    )
    ->Generate();
  }
}