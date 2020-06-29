<?php

abstract class Node
{
  abstract function Generate() : string;

  static function Create() {
    return new static;
  }

  static function Run(Node $root) {
    echo @$root->Generate();
  }
}