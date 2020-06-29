<?php

require_once(__DIR__ . "/../Core/Node.php");
require_once(__DIR__ . "/../Core/Queue.php");
require_once(__DIR__ . "/Frame.php");

class FrameBlock extends Node 
{
  private $Frames;
  private $Key = "";

  function __construct() {
    $this->Frames = (new Queue)
    ->LeftPrefix(" ");
  }

  /// Key
  function Key(string $string) {
    $this->Key = $string;
    return $this;
  }

  function GetKey() : string {
    return $this->Key;
  }

  /// Parameters
  function Frames($nodes) {
    $this->Frames->Children($nodes);
    return $this;
  }

  function GetFrames() : array {
    return $this->Frames->GetChildren();
  }

  /// Generate
  function Generate(): string {
    return "@keyframes ".$this->Key." {".$this->Frames->Generate()." }";
  }
}