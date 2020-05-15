<?php

require_once(__DIR__ . "/../Core/GeneratedObject.php");
require_once(__DIR__ . "/ThemeBlock.php");
require_once(__DIR__ . "/../Core/Queue.php");

class Theme extends GeneratedObject
{
  private $Blocks;

  function __construct() {
    $this->Blocks = new Queue;
  }

  function AddBlock(ThemeBlock $block) {
    $this->Blocks->AddChild($block);
    return $this;
  }

  function GetBlocks() : array {
    return $this->Blocks->GetChilds();
  }

  function Generate() : string {
    return $this->Blocks->Generate();
  }
  
}