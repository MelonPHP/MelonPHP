<?php

require_once(__DIR__ . "/Node.php");

class Queue extends Node
{
  private $Children = array();
  private $PrefixLeft = "";
  private $PrefixRight = "";

  /// PrefixLeft
  function LeftPrefix(string $string) {
    $this->PrefixLeft = $string;
    return $this;
  }

  function GetLeftPrefix() {
    return $this->PrefixLeft;
  }

  /// PrefixRight
  function RightPrefix(string $string) {
    $this->PrefixRight = $string;
    return $this;
  }

  function GetRightPrefix() {
    return $this->PrefixRight;
  }

  /// Children
  function Children($nodes /*node or array of node or string array or string*/) {
    if (!is_array($nodes))
      array_push($this->Children, $nodes);
    else
      foreach ($nodes as $node) {
        array_push($this->Children, $node);
      }
    return $this;
  }

  function GetChildren() : array {
    return $this->Children;
  }

  /// Generate
  function Generate() : string {
    $str = "";
    foreach ($this->Children as $child) {
      $str .= $this->PrefixLeft.(is_string($child) ? $child : $child->Generate()).$this->PrefixRight;
    }
    return $str;
  }
}