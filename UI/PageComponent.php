<?php

require_once(__DIR__ . "/ThinkingComponent.php");

abstract class PageComponent extends ThinkingComponent
{
  static function Display() {
    echo @self::Create()->Build()->Generate();
  }
}