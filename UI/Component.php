<?php

require_once(__DIR__ . "/../Includes/Core.php");

abstract class Component extends Node
{
  abstract function Build() : Node /* html */;

  public function Generate() : string {
    return $this->Build()->Generate();
  }
}