<?php

require_once(__DIR__ . "/../components/include.php");
require_once(__DIR__ . "/../teamples/include.php");
require_once(__DIR__ . "/../elements/include.php");
require_once(__DIR__ . "/../../libs/include_tree-php.php");
require_once(__DIR__ . "/../../backend/include.php");

class RegistratePage extends Component
{
  private $Name = "";
  private $LastName = "";
  private $Login = "";
  private $Password = "";
  private $PasswordRepeat = "";
  private $Message = "";

  function Think() {
    if ($this->Password != $this->PasswordRepeat)
      return "Пароли не совпадают";

    $registerResult = ProfileController::GetInstance()
    ->Create(
      $this->Name,
      $this->LastName,
      $this->Login,
      $this->Password
    );
    
    switch ($registerResult) {
      case ProfileCreateEnum::Ok:
        Controller::RedirectTo("LoginPage.php?login_or_email=".$this->Login);
      case ProfileCreateEnum::BadLogin:
        return "Неправильный формат логина";
      case ProfileCreateEnum::BadPassword:
        return "Неправильный формат пароля";
      case ProfileCreateEnum::BadName:
        return "Неправильный формат имени";
      case ProfileCreateEnum::BadLastName:
        return "Неправильный формат фамилии";
      case ProfileCreateEnum::Exists:
        return "Пользователь уже существует с таким логином";
      case ProfileCreateEnum::ServerError:
        return "Произошла ошибка на стороне сервера";
      default:
        return "Неизвестная ошибка";
    }
  }

  function __construct() {
    parent::__construct();
    if (isset($_GET["name"]))
      $this->Name = $_GET["name"];
    if (isset($_GET["last_name"]))
      $this->LastName = $_GET["last_name"];
    if (isset($_GET["login"]))
      $this->Login = $_GET["login"];
    if (isset($_GET["login"]))
      $this->Password = $_GET["password"];
    if (isset($_GET["password_repeat"]))
      $this->PasswordRepeat = $_GET["password_repeat"];

    if (
      !empty($this->Name)
      && !empty($this->LastName)
      && !empty($this->Login)
      && !empty($this->Password)
      && !empty($this->PasswordRepeat)
    )
      $this->Message = $this->Think();
  }

  function BuildForm() : Element {
    return (new Action)
    ->Child(
      Column::Create()
      ->Children([
        Text::Create()
        ->ThemeParameter(FontSize, Px(22))
        ->Text("Присоеденитесь к Graver"),
        Space::Create(),
        Row::Create()
        ->CrossAlign(CrossAxisAligns::End)
        ->ThemeParameter(Height, Auto)
        ->Children([
          Text::Create()
          ->Text("У вас уже есть аккаунт?"),
          Space::Create()
          ->Orientation(Space::Horizontal)
          ->Spacing(Px(5)),
          (new Link)
          ->Link("LoginPage.php")
          ->Child("Войдите в него!")
        ]),
        Space::Create(),
        Row::Create()
        ->ThemeParameter(Height, Auto)
        ->Children([
          (new TextField)
          ->ActionKey("name")
          ->ThemeKeys("graver_auth_field")
          ->Placeholder("Имя")
          ->Text($this->Name),
          Space::Create()
          ->Orientation(Space::Horizontal)
          ->Spacing(Px(10)),
          (new TextField)
          ->ActionKey("last_name")
          ->ThemeKeys("graver_auth_field")
          ->Placeholder("Фамилия")
          ->Text($this->LastName)
        ]),
        Space::Create(),
        Text::Create()
        ->Text("Логин должен состоять из минимум 7 латинских букв или цифр"),
        Space::Create(),
        (new TextField)
        ->ActionKey("login")
        ->ThemeKeys("graver_auth_field")
        ->Placeholder("Логин")
        ->Text($this->Login),
        Space::Create(),
        Text::Create()
        ->Text("Пароль должен быть длинее 7 символов и содержать одну цифру, букву, и заглавную букву"),
        Space::Create(),
        (new PasswordField)
        ->ActionKey("password")
        ->ThemeKeys("graver_auth_field")
        ->Placeholder("Пароль")
        ->Text($this->Password),
        Space::Create(),
        (new PasswordField)
        ->ActionKey("password_repeat")
        ->ThemeKeys("graver_auth_field")
        ->Placeholder("Повтор пароля")
        ->Text($this->PasswordRepeat),
        Space::Create(),
        !empty($this->Message)
          ? Column::Create()
          ->Children([
            (new ShakeErrorText)
            ->Text($this->Message),
            Space::Create()
          ])
          : new Container,
        (new Button)
        ->ThemeKeys("graver_auth_button")
        ->Text("Присоеденится")
      ])
    );
  }

  function Build() : Node {
    return (new AuthTeample("Присоеденитесь"))
    ->Child($this->BuildForm());
  }
}

Node::Run(new RegistratePage);