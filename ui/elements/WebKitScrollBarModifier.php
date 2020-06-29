<?php

require_once(__DIR__ . "/../../libs/include_tree-php.php");

class WebKitScrollBarModifier extends Modifier
{
  function __construct() {
    parent::__construct(":-webkit-scrollbar");
  }
}