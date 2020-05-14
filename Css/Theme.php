<?php

require_once(__DIR__ . "/../Core/GeneratedObject.php");
require_once(__DIR__ . "/ThemeBlock.php");

class Theme extends GeneratedObject
{
  private $Blocks = array();

  function AddBlock(ThemeBlock $block) {
    array_push($this->Blocks, $block);
    return $this;
  }

  function GetBlocks() : array {
    return $this->Blocks;
  }

  function Generate() : string {
    $string = "";
    foreach ($this->Blocks as $block) {
      $string .= $block->Generate();
    }
    return $string;
  }
  
}