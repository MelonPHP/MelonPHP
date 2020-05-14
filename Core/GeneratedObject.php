<?php

abstract class GeneratedObject
{
  abstract function Generate();

  static public function RunOf(GeneratedObject $object) {
    echo @$object->Generate();
  }
}