<?php

require_once(__DIR__ . "/../Core/GeneratedObject.php");
require_once(__DIR__ . "/ThemeBlock.php");
require_once(__DIR__ . "/FrameBlock.php");
require_once(__DIR__ . "/../Core/Queue.php");

class Theme extends GeneratedObject
{
  private $Blocks;
  private $KeyFrames;

  function __construct() {
    $this->Blocks = (new Queue)
    ->SetPrefix(" ", "");
    $this->KeyFrames = (new Queue)
    ->SetPrefix(" ", "");
  }

  function AddThemeBlock(ThemeBlock $block) {
    $this->Blocks->AddChild($block);
    return $this;
  }

  function GetThemeBlocks() : array {
    return $this->Blocks->GetChilds();
  }

  function AddFrameBlock(FrameBlock $keyframe) {
    $this->KeyFrames->AddChild($keyframe);
    return $this;
  }

  function GetFrameBlocks() : array {
    return $this->KeyFrames->GetChilds();
  }

  function Generate() : string {
    return $this->Blocks->Generate().$this->KeyFrames->Generate();
  }
  
}