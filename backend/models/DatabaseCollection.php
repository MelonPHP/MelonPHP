<?php

require_once(__DIR__ . "/../../libs/include_medoo.php");

use Medoo\Medoo;

class DatabaseCollection
{
  static function GetGraverDB() : Medoo {
    return new Medoo([
      'database_type' => 'mysql',
      'database_name' => 'graver',
      'server' => 'localhost',
      'username' => 'root',
      'password' => '11111111'
    ]);
  }
}