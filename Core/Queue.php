<?php

require_once(__DIR__ . "/GeneratedObject.php");

class Queue extends GeneratedObject
{
  private $Childs = array();
  private $Prefix = "";
  private $RightPrefix = "";

  function AddChild(GeneratedObject $item) {
    array_push($this->Childs, $item);
    return $this;
  }

  function GetChilds() : array {
    return $this->Childs;
  }

  function SetPrefix(string $left, string $right) {
    $this->Prefix = $left;
    $this->RightPrefix = $right;
  }

  function GetPrefix() : string {
    return $this->Prefix;
  }

  function GetPrefixRight() : string {
    return $this->RightPrefix;
  }

  function Generate() : string {
    $string = "";
    foreach ($this->Childs as $child) {
      $string .= $this->Prefix.$child->Generate().$this->PrefixRight;
    }
    return $string;
  }
}