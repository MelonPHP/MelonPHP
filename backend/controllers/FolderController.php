<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../models/include.php");

use Medoo\Medoo;

class FolderController extends Controller
{
  private static $instances = [];

  public static function GetInstance() : FolderController
  {
      $cls = static::class;
      if (!isset(self::$instances[$cls])) {
          self::$instances[$cls] = new static;
      }

      return self::$instances[$cls];
  }

  function __construct() {
    parent::__construct(DatabaseCollection::GetGraverDB());
  }

  function ExistsByID($id) : bool {
    return $this->GetDB()->count("folders", [
      'id' => $id
    ]) > 0 ? true : false;
  }

  function DeleteFolder($id) {
    return $this->GetDB()->delete("folders", [
      "id" => $id
    ]);
  }

  function GetFolders($projectID) : array {
    return $this->GetDB()->select("folders", "*", [
      "project_id" => $projectID
    ]);
  }

  function GetFoldersID($projectID) : array {
    return $this->GetDB()->select("folders", "id", [
      "project_id" => $projectID
    ]);
  }

  function GetFolder($id) {
    return $this->GetDB()->select("folders", "*", [
      "id" => $id
    ])[0];
  }

  function AddFolder($projectID, string $name) {
    $this->GetDB()->insert("folders", [
      "project_id" => $projectID,
      "name" => $name
    ]);
  }
}