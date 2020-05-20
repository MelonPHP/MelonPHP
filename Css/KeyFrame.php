<?php

require_once(__DIR__ . "/../Core/GeneratedObject.php");
require_once(__DIR__ . "/../Core/Queue.php");
require_once(__DIR__ . "/Frame.php");

class KeyFrame extends GeneratedObject
{
  private $Key = "";
  private $Frames;

  function __construct() {
    $this->Frames = (new Queue)
    ->SetPrefix(" ", "");
  }

  function SetKey(string $string) {
      $this->Key = $string;
      return $this;
  }

  function GetKey() : string {
    return $this->Key;
  }

  function AddFrame(Frame $frame) {
    $this->Frames->AddChild($frame);
    return $this;
  }

  function GetFrames() : array {
    return $this->Frames->GetChilds();
  }

  function Generate() : string {
    return "@keyframes ".$this->Key." {".$this->Frames->Generate()."}";
  }
}