<?php namespace Generator;

require_once("Html.php");
require_once("HtmlArgument.php");

class Element extends Html
{
  private $Arguments = array();
  private $StyleArgument;
  private $ClassArgument;

  function __construct() {
    $this->StyleArgument = (new Argument)->SetName("style");
    $this->ClassArgument = (new Argument)->SetName("class");
  }

  function AddThemeKey(string $key) {
    $this->ClassArgument
    ->AddItem($string);
    return $this;
  }

  function GetThemesKeys() : array {
    return $this->ClassArgument
    ->GetItems();
  }

  function AddLocalStyle(string $name, string $value) {
    $this->StyleArgument
    ->AddItem($name.": ".$value.";");
    return $this;
  }

  function AddArgument(Argument $argument) {
    array_push($this->Arguments, $argument);
    return $this;
  }

  function GetArguments() : array {
    $arguments = array();
    array_push($arguments, $this->ClassArgument);
    array_push($arguments, $this->StyleArgument);
    array_push($arguments, $this->Arguments);
    return $arguments;
  }

}