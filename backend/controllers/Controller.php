<?php

require_once(__DIR__ . "/../../libs/include_medoo.php");

use Medoo\Medoo;

abstract class Controller
{
  private $Database;

  function __construct(Medoo $database) {
    $this->Database = $database;
  }

  function GetDB() : Medoo {
    return $this->Database;
  }

  static function RedirectTo(string $url) {
    header("Location: $url");
    exit;
  }
}