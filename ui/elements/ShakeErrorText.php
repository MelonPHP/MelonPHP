<?php

require_once(__DIR__ . "/../../libs/include_tree-php.php");

class ShakeErrorText extends Text
{
  function __construct() {
    parent::__construct();
    $this->ThemeKeys("graver_shake_error_text");
  }
}