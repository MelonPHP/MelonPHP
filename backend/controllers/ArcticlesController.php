<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/SessionController.php");
require_once(__DIR__ . "/../models/include.php");

use Medoo\Medoo;

class ArticlesController extends Controller
{
  private static $instances = [];

  public static function GetInstance() : ArticlesController
  {
      $cls = static::class;
      if (!isset(self::$instances[$cls])) {
          self::$instances[$cls] = new static;
      }

      return self::$instances[$cls];
  }
  
  private function __construct() {
    parent::__construct(DatabaseCollection::GetGraverDB());
  }

  function AddArticle(string $name, string $url, string $text) : bool {
    if (strlen($name) > 40)
      $name = mb_substr($name, 0, 47)."...";

    $this->GetDB()->insert("articles", [
      "title" => $name,
      "data" => $text,
      "picture" => $url
    ]);
    
    return true;
  }

  function GetTextById($id) : string {
    return $this->GetDB()->select("articles", [
      "data",
    ], [
      "id" => $id
    ])[0]["data"];
  }

  function GetArticles() {
    return $this->GetDB()->select("articles", [
      "id",
      "title",
      "picture"
    ], [
      "ORDER" => ["id" => "DESC"]
    ]);
  }
}