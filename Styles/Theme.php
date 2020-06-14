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
    ->SetLeftPrefix(" ");
    $this->FrameBlocks = (new Queue)
    ->SetLeftPrefix(" ");
  }

  /// TargetMinWidth
  function SetMinWidth(string $string) {
    $this->TargetMinWidth = $string;
    return $this;
  }

  function GetMinWidth(string $string) : string {
    return $this->TargetMinWidth;
  }

  /// TargetMaxWidth
  function SetMaxWidth(string $string) {
    $this->TargetMaxWidth = $string;
    return $this;
  }

  function GetMaxWidth(string $string) : string {
    return $this->TargetMaxWidth;
  }

  /// TargetMinHeight
  function SetMinHeight(string $string) {
    $this->TargetMinHeight = $string;
    return $this;
  }

  function GetMinHeight(string $string) : string {
    return $this->TargetMinHeight;
  }

  /// TargetMaxHeight
  function SetMaxHeight(string $string) {
    $this->TargetMaxHeight = $string;
    return $this;
  }

  function GetMaxHeight(string $string) : string {
    return $this->TargetMaxHeight;
  }

  /// ThemeBlocks
  function SetThemeBlocks(array $nodes) {
    $this->ThemeBlocks->SetChilds($nodes);
    return $this;
  }

  function AddThemeBlocks(array $nodes) {
    $this->ThemeBlocks->AddChilds($nodes);
    return $this;
  }

  function AddThemeBlock(ThemeBlock $node) {
    $this->ThemeBlocks->AddChild($node);
    return $this;
  }

  function GetThemeBlocks() : array {
    return $this->ThemeBlocks->GetChilds();
  }

  /// FrameBlocks
  function SetFrameBlocks(array $nodes) {
    $this->FrameBlocks->SetChilds($nodes);
    return $this;
  }

  function AddFrameBlocks(array $nodes) {
    $this->FrameBlocks->AddChilds($nodes);
    return $this;
  }

  function AddFrameBlock(FrameBlock $node) {
    $this->FrameBlocks->AddChild($node);
    return $this;
  }

  function GetFrameBlocks() : array {
    return $this->FrameBlocks->GetChilds();
  }

  /// Generate
  // TODO: Refactor. Add Css constants
  function GenerateMedias(string $content) : string {
    $medias = (new Queue)
    ->SetLeftPrefix(" and (")
    ->SetRightPrefix(")");
    if (!empty($this->TargetMinWidth))
      $medias->AddChild(
        (new ThemeParameter)
        ->SetName("min-width")
        ->SetValue($this->TargetMinWidth)
      );
    if (!empty($this->TargetMaxWidth))
      $medias->AddChild(
        (new ThemeParameter)
        ->SetName("max-width")
        ->SetValue($this->TargetMaxWidth)
      );
    if (!empty($this->TargetMinHeight))
      $medias->AddChild(
        (new ThemeParameter)
        ->SetName("min-height")
        ->SetValue($this->TargetMinHeight)
      );
    if (!empty($this->TargetMaxHeight))
      $medias->AddChild(
        (new ThemeParameter)
        ->SetName("max-height")
        ->SetValue($this->TargetMaxHeight)
      );
    if (count($medias->GetChilds()) > 0) {
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