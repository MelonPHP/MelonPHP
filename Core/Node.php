<?php

abstract class Node
{
  abstract function Generate() : string;

  static function Run(Document $root) {
    echo @$root->Generate();
  }
}