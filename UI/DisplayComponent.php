<?php

require_once(__DIR__ . "/Component.php");

abstract class DisplayComponent extends Component
{
  abstract function Build() : Document;
  
  static function Display() {
    echo @self::Create()->Build()->Generate();
  }
}