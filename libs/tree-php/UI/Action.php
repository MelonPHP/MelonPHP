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

    $this->Varibles = Queue::Create();

    $this->Type(ActionTypes::Get);
  }

  /// Varibles
  function Varibles($varibles) {
    $this->Varibles->Children($varibles);
    return $this;
  }

  function GetVaribles() : array {
    return $this->Varibles->GetChildren();
  }

  /// Type
  function Type(string $type) {
    $this->Type = $type;
    return $this;
  }

  function GetType() : string {
    return $this->Type;
  }

  /// Redirect
  function Redirect(string $uri) {
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
      $args->Children([
        Argument::Create()
        ->Name("action")
        ->Value($this->Redirect)
      ]);
    if (!empty($this->Type))
      $args->Children([
        Argument::Create()
        ->Name("method")
        ->Value($this->Type)
      ]);
    return $args;
  }

  function Generate() : string {
    return Tag::Create()
    ->Name("form")
    ->Arguments($this->GetArguments()->GetChildren())
    ->Child(
      Queue::Create()
      ->Children($this->GetChild())
      ->Children($this->GetVaribles())
    )
    ->Generate();
  }

  static function Create() : Action {
    return new Action;
  }

  static function GetValue(string $name, $standart = null, string $type = ActionTypes::Get) {
    switch ($type) {
      case ActionTypes::Get:
        return isset($_GET[$name]) ? $_GET[$name] : $standart;
      case ActionTypes::Post:
        return isset($_POST[$name]) ? $_POST[$name] : $standart;
      default:
        throw "error";
    }
  }
}