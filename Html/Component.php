<?php

require_once(__DIR__ . "/../Core/GeneratedObject.php");

abstract class Component extends GeneratedObject
{
  abstract function Build() /* html */;

  public function Generate() : string {
    return $this->Build()->Generate();
  }
}