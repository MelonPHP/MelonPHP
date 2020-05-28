<?php

require_once(__DIR__ . "/Node.php");

class Queue extends Node
{
  private $Childs = array();
  private $PrefixLeft = "";
  private $PrefixRight = "";

  /// PrefixLeft
  function SetLeftPrefix(string $string) {
    $this->PrefixLeft = $string;
    return $this;
  }

  function GetLeftPrefix() {
    return $this->PrefixLeft;
  }

  /// PrefixRight
  function SetRightPrefix(string $string) {
    $this->PrefixRight = $string;
    return $this;
  }

  function GetRightPrefix() {
    return $this->PrefixRight;
  }

  /// Childs
  function SetChilds(array $nodes /*node or string*/) {
    $this->Childs = $nodes;
    return $this;
  }

  function AddChilds(array $nodes /*node or string*/) {
    foreach ($nodes as $node) {
      array_push($this->Childs, $node);
    }
    return $this;
  }

  function AddChild($node /*node or string*/) {
    array_push($this->Childs, $node);
    return $this;
  }

  function GetChilds() : array {
    return $this->Childs;
  }

  /// Generate
  function Generate() : string {
    $str = "";
    foreach ($this->Childs as $child) {
      $str .= $this->PrefixLeft.(is_string($child) ? $child : $child->Generate()).$this->PrefixRight;
    }
    return $str;
  }
}