<?php

require_once(__DIR__ . "/../Core/GeneratedObject.php");
require_once(__DIR__ . "/ThemeBlock.php");
require_once(__DIR__ . "/KeyFrame.php");
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

  function AddBlock(ThemeBlock $block) {
    $this->Blocks->AddChild($block);
    return $this;
  }

  function GetBlocks() : array {
    return $this->Blocks->GetChilds();
  }

  function AddKeyFrame(KeyFrame $keyframe) {
    $this->KeyFrames->AddChild($keyframe);
    return $this;
  }

  function GetKeyFrames() : array {
    return $this->KeyFrames->GetChilds();
  }

  function Generate() : string {
    return $this->Blocks->Generate().$this->KeyFrames->Generate();
  }
  
}