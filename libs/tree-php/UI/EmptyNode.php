<?php

require_once(__DIR__ . "/../Core/Queue.php");
require_once(__DIR__ . "/../Core/Node.php");
require_once(__DIR__ . "/../Styles/ThemeParameter.php");
require_once(__DIR__ . "/../Styles/CssConstants.php");

class EmptyNode extends Node
{
  function Generate() : string {
    return " ";
  }
}