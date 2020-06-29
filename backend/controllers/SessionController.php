<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../models/include.php");

use Medoo\Medoo;

class SessionController extends Controller
{
  private static $instances = [];

  public static function GetInstance() : SessionController
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

  function GenerateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  function ExistsByKey(string $key) : bool {
    return $this->GetDB()->count("sessions", [
      'sessions.key' => $key,
    ]) > 0 ? true : false;
  }

  function GetIDByKey(string $key) : int {
    return $this->GetDB()->select("sessions", [
      "id"
    ], [
      "key" => $key
    ])[0]["id"];
  }

  function GetProfileIdByKey(string $key) : int {
    return $this->GetDB()->select("sessions", [
      "profile_id"
    ], [
      "key" => $key
    ])[0]["profile_id"];
  }

  function Create(
    $login,
    $password,
    &$key
  ) {
    // check on empty
    if (empty($login))
      return SessionCreateEnum::BadLogin;
    if (empty($password))
      return SessionCreateEnum::BadPassword;

    $user = $this->GetDB()->select("profiles", [
      "id"
    ], [
      'nick_name' => $login,
      'password' => md5($password)
    ]);

    if (count($user) == 0)
      return SessionCreateEnum::UserNotExists;
    
    $id = $user[0]["id"];

    $key = $this->GenerateRandomString(32);

    if ($this->GetDB()->insert("sessions", [
      'profile_id' => $id,
      'key' => $key
    ])) {
      setcookie("session_key", $key);
      return SessionCreateEnum::Ok;
    }
    else
      return SessionCreateEnum::ServerError;
  }
}