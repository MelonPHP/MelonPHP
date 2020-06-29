<?php

require_once(__DIR__ . "/../components/include.php");
require_once(__DIR__ . "/../teamples/include.php");
require_once(__DIR__ . "/../elements/include.php");
require_once(__DIR__ . "/../../libs/include_tree-php.php");
require_once(__DIR__ . "/../../backend/include.php");

class LoginPage extends Component
{
  private $Password = "";
  private $Login = "";
  private $Message = "";

  function Think() {
    $loginResult = SessionController::GetInstance()
    ->Create($this->Login, $this->Password, $key);
    
    switch ($loginResult) {
      case SessionCreateEnum::Ok:
        $_COOKIE["session_key"] = $key;
        Controller::RedirectTo("HomePage.php");
      case SessionCreateEnum::BadLogin:
        return "Неправильный формат логина";
      case SessionCreateEnum::BadPassword:
        return "Неправильный формат пароля";
      case SessionCreateEnum::UserNotExists:
        return "Пользователь не найден";
      case SessionCreateEnum::ServerError:
        return "Произошла ошибка на стороне сервера";
      default:
        return "Неизвестная ошибка";
    }
  }

  function __construct() {
    parent::__construct();
    if (isset($_GET["login_or_email"]))
      $this->Login = $_GET["login_or_email"];
    if (isset($_GET["password"]))
      $this->Password = $_GET["password"];

    if (!empty($this->Login) && !empty($this->Password)) 
      $this->Message = $this->Think();
  }

  function BuildForm() : Node {
    return (new Action)
    ->Child(
      Column::Create()
      ->Children([
        Text::Create()
        ->ThemeParameter(FontSize, Px(22))
        ->Text("Войдите в Ваш аккаунт"),
        Space::Create(),
        Row::Create()
        ->CrossAlign(CrossAxisAligns::End)
        ->ThemeParameter(Height, Auto)
        ->Children([
          Text::Create()
          ->Text("У вас нет аккаунта?"),
          Space::Create()
          ->Orientation(Space::Horizontal)
          ->Spacing(Px(5)),
          (new Link)
          ->Link("RegistratePage.php")
          ->Child("Создайте его!")
        ]),
        Space::Create(),
        (new TextField)
        ->ActionKey("login_or_email")
        ->ThemeKeys("graver_auth_field")
        ->Placeholder("Логин или email")
        ->Text($this->Login),
        Space::Create(),
        (new PasswordField)
        ->ActionKey("password")
        ->ThemeKeys("graver_auth_field")
        ->Placeholder("Пароль")
        ->Text($this->Password),
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
        ->Text("Войти")
      ])
    );
  }

  function Build() : Element {
    return (new AuthTeample("Вход"))
    ->Child($this->BuildForm());
  }
}

Node::Run(new LoginPage);