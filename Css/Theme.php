<?php

require_once(__DIR__ . "/../Core/GeneratedObject.php");
require_once(__DIR__ . "/ThemeBlock.php");
require_once(__DIR__ . "/FrameBlock.php");
require_once(__DIR__ . "/ThemeParameter.php");
require_once(__DIR__ . "/../Core/Queue.php");

class Theme extends GeneratedObject
{
  private $Blocks;
  private $KeyFrames;

  private $Medias = array();

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

  function AddMedia(string $tag, string $value) {
    array_push($this->Medias, $tag.": ".$value);
    return $this;
  }

  function GetMedias() : array {
    return $this->Medias;
  }

  function GenerateMedias() : string {
    $string = "";
    foreach ($this->Medias as $media) {
      $string .= " and (".$media.")";
    }
    return $string;
  }

  function Generate() : string {
    if (count($this->Medias) > 0)
      return "@media screen".$this->GenerateMedias()." {".$this->Blocks->Generate().$this->KeyFrames->Generate()."}";
    else
      return $this->Blocks->Generate().$this->KeyFrames->Generate();
  }
  
}