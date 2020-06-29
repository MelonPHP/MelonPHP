<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/SessionController.php");
require_once(__DIR__ . "/../models/include.php");

use Medoo\Medoo;

class ProjectsController extends Controller
{
  private static $instances = [];

  public static function GetInstance() : ProjectsController
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

  function ExistsByID($id) : bool {
    return $this->GetDB()->count("projects", [
      'id' => $id
    ]) > 0 ? true : false;
  }

  function AddProject(string $name, string $url, string $key) : bool {
    if (!SessionController::GetInstance()->ExistsByKey($key))
      return false;

    $id = SessionController::GetInstance()->GetProfileIdByKey($key);

    if (strlen($name) > 18)
      $name = mb_substr($name, 0, 15)."...";

    $this->GetDB()->insert("projects", [
      "profile_id" => $id,
      "title" => $name,
      "picture" => $url,
      "type" => 0 /* to-do application */
    ]);
    
    return true;
  }

  function Count(string $key) {
    if (!SessionController::GetInstance()->ExistsByKey($key))
      return null;

    $id = SessionController::GetInstance()->GetProfileIDByKey($key);

    return $this->GetDB()->count("projects", [
      "profile_id" => $id
    ]);
  }

  function GetProjects(string $key) {
    if (!SessionController::GetInstance()->ExistsByKey($key))
      return array();

    $id = SessionController::GetInstance()->GetProfileIDByKey($key);

    return $this->GetDB()->select("projects", "*", [
      "profile_id" => $id
    ]);
  }

  function DeleteProject($id) {
    return $this->GetDB()->delete("projects", [
      "id" => $id
    ]);
  }

  function GetProject(string $key, $id) {
    if (!SessionController::GetInstance()->ExistsByKey($key))
      return array();

    $profileId = SessionController::GetInstance()->GetProfileIDByKey($key);

    return $this->GetDB()->select("projects", "*", [
      "profile_id" => $profileId,
      "id" => $id
    ])[0];
  }
}