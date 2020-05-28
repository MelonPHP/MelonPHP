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
    ->SetLeftPrefix(" ");
  }

  /// Key
  function SetKey(string $string) {
    $this->Key = $string;
    return $this;
  }

  function GetKey() : string {
    return $this->Key;
  }

  /// Parameters
  function SetFrames(array $nodes) {
    $this->Frames->SetChilds($nodes);
    return $this;
  }

  function AddFrames(array $nodes) {
    $this->Frames->AddChilds($nodes);
    return $this;
  }

  function AddFrame(Frame $node) {
    $this->Frames->AddChild($node);
    return $this;
  }

  function GetFrames() : array {
    return $this->Frames->GetChilds();
  }

  /// Generate
  function Generate(): string {
    return "@keyframes ".$this->Key." {".$this->Frames->Generate()." }";
  }
}