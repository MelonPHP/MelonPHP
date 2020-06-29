<?php

require_once(__DIR__ . "/../Core/Node.php");
require_once(__DIR__ . "/../Core/Queue.php");
require_once(__DIR__ . "/ThemeBlock.php");

class Theme extends Node
{
  private $TargetMinWidth = "";
  private $TargetMaxWidth = "";

  private $TargetMinHeight = "";
  private $TargetMaxHeight = "";

  private $ThemeBlocks;
  private $FrameBlocks;

  function __construct() {
    $this->ThemeBlocks = (new Queue)
    ->LeftPrefix(" ");
    $this->FrameBlocks = (new Queue)
    ->LeftPrefix(" ");
  }

  /// TargetMinWidth
  function MinWidth(string $string) {
    $this->TargetMinWidth = $string;
    return $this;
  }

  function GetMinWidth(string $string) : string {
    return $this->TargetMinWidth;
  }

  /// TargetMaxWidth
  function MaxWidth(string $string) {
    $this->TargetMaxWidth = $string;
    return $this;
  }

  function GetMaxWidth(string $string) : string {
    return $this->TargetMaxWidth;
  }

  /// TargetMinHeight
  function MinHeight(string $string) {
    $this->TargetMinHeight = $string;
    return $this;
  }

  function GetMinHeight(string $string) : string {
    return $this->TargetMinHeight;
  }

  /// TargetMaxHeight
  function MaxHeight(string $string) {
    $this->TargetMaxHeight = $string;
    return $this;
  }

  function GetMaxHeight(string $string) : string {
    return $this->TargetMaxHeight;
  }

  /// ThemeBlocks
  function ThemeBlocks($nodes) {
    $this->ThemeBlocks->Children($nodes);
    return $this;
  }

  function GetThemeBlocks() : array {
    return $this->ThemeBlocks->GetChildren();
  }

  /// FrameBlocks
  function FrameBlocks($nodes) {
    $this->FrameBlocks->Children($nodes);
    return $this;
  }

  function GetFrameBlocks() : array {
    return $this->FrameBlocks->GetChildren();
  }

  /// Generate
  // TODO: Refactor. Add Css constants
  function GenerateMedias(string $content) : string {
    $medias = (new Queue)
    ->LeftPrefix(" and (")
    ->RightPrefix(")");
    if (!empty($this->TargetMinWidth))
      $medias->Children([
        ThemeParameter::Create()
        ->Name("min-width")
        ->Value($this->TargetMinWidth)
      ]);
    if (!empty($this->TargetMaxWidth))
      $medias->Children([
        ThemeParameter::Create()
        ->Name("max-width")
        ->Value($this->TargetMaxWidth)
      ]);
    if (!empty($this->TargetMinHeight))
      $medias->Children([
        ThemeParameter::Create()
        ->Name("min-height")
        ->Value($this->TargetMinHeight)
      ]);
    if (!empty($this->TargetMaxHeight))
      $medias->Children([
        ThemeParameter::Create()
        ->Name("max-height")
        ->Value($this->TargetMaxHeight)
      ]);
    if (count($medias->GetChildren()) > 0) {
      return "@media screen".$medias->Generate()." {".$content." }";
    }
    else
      return $content;
  }

  function Generate() : string {
    return $this->GenerateMedias(
      $this->ThemeBlocks->Generate()
      .$this->FrameBlocks->Generate()
    );
  }
}