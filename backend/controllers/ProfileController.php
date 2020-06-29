<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../models/include.php");

use Medoo\Medoo;

class ProfileController extends Controller
{
  private static $instances = [];

  public static function GetInstance() : ProfileController
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

  function ExistsByLogin(
    $login
  ) : bool {
    return count($this->GetDB()->select("profiles", [
      "id"
    ], [
      'nick_name' => $login
    ])) > 0 ? true : false;
  }

  function Create(
    $name,
    $lastName,
    $login,
    $password
  ) : int {
    // check on empty
    if (empty($name))
      return ProfileCreateEnum::BadName;
    if (empty($lastName))
      return ProfileCreateEnum::BadLastName;
    if (empty($login))
      return ProfileCreateEnum::BadLogin;
    if (empty($password))
      return ProfileCreateEnum::BadPassword;

    // check format
    $nameMask = "/[^a-zA-Zа-яёА-ЯЁ]/u";
    $loginMask = "/[^A-Za-z0-9]/";
    if (preg_match($nameMask, $name))
      return ProfileCreateEnum::BadName;
    if (preg_match($nameMask, $lastName))
      return ProfileCreateEnum::BadLastName;
    if (preg_match($loginMask, $login))
      return ProfileCreateEnum::BadLogin;
    if (
      preg_match($loginMask, $password)
      || strlen($password) < 8
    )
      return ProfileCreateEnum::BadPassword;

    if ($this->ExistsByLogin($login))
      return ProfileCreateEnum::Exists;

    if ($this->GetDB()->insert("profiles", [
      'first_name' => $name,
      'last_name' => $lastName,
      'nick_name' => $login,
      'password' => md5($password),
    ]))
      return ProfileCreateEnum::Ok;
    else
      return ProfileCreateEnum::ServerError;
  }
}