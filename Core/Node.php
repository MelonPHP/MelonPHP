<?php

abstract class Node
{
  abstract function Generate() : string;

  static function Run(Node $root) {
    echo @$root->Generate();
  }
}