<?php

abstract class Node
{
  abstract function Generate() : string;

  static function Create() {
    return new static;
  }
}