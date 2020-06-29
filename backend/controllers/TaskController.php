<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../models/include.php");

use Medoo\Medoo;

class TaskController extends Controller
{
  private static $instances = [];

  public static function GetInstance() : TaskController
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

  function GetTasks($folderID) : array {
    $tasks = $this->GetDB()->select("task", "*", [
      "folder_id" => $folderID
    ]);
    return $tasks == false ? array() : $tasks;
  }

  function GetTasksIDInFolder($folderID) : array {
    return $this->GetDB()->select("task", "id", [
      "folder_id" => $folderID
    ]);
  }

  function DeleteTask($id) {
    return $this->GetDB()->delete("task", [
      "id" => $id
    ]);
  }

  function GetTasksCountInFolder($folderID)  {
    return $this->GetDB()->count("task", [
      "folder_id" => $folderID
    ]);
  }

  function AddTask($folderID, string $name) {
    $this->GetDB()->insert("task", [
      "folder_id" => $folderID,
      "name" => $name
    ]);
  }
}