<?php

require_once(__DIR__ . "/../components/include.php");
require_once(__DIR__ . "/../teamples/include.php");
require_once(__DIR__ . "/../elements/include.php");
require_once(__DIR__ . "/../../libs/include_tree-php.php");
require_once(__DIR__ . "/../../backend/include.php");

class CreateProjectPage extends Component
{
  private $Name = "";
  private $Picture = "";
  private $Message = "";

  function Think() {
    if (isset($_POST["name"]))
      $this->Name = $_POST["name"];
    if (isset($_POST["link"]))
      $this->Picture = $_POST["link"];

    if (empty($this->Name) || empty($this->Picture))
      return;

    $nameMask = "/[^a-zA-Zа-яёА-ЯЁ ]/u";
    if (preg_match($nameMask, $this->Name) || strlen($this->Picture) < 4) {
      $this->Message = "Неправильный формат полей";
      return;
    }

    if (!ProjectsController::GetInstance()->AddProject(
      $this->Name,
      $this->Picture,
      $_COOKIE["session_key"]
    ))
      $this->Message = "Не удалось создать проект";
    else
      Controller::RedirectTo("HomePage.php");
  }

  function __construct() {
    parent::__construct();
    $this->Think();
  }

  function BuildContent() : Element {
    return Column::Create()
    ->Children([
      Text::Create()
      ->Text("Тестовый диалог создания проекта в Graver!"),
      Space::Create(),
      (new TextField)
      ->ThemeKeys("graver_field")
      ->Placeholder("Название проекта")
      ->Text($this->Name)
      ->ActionKey("name"),
      Space::Create(),
      (new TextField)
      ->ThemeKeys("graver_field")
      ->Placeholder("Ссылка на изображение")
      ->Text($this->Picture)
      ->ActionKey("link"),
      Space::Create(),
      !empty($this->Message)
        ? (new ShakeErrorText)
          ->Text($this->Message)
        : new Container,
    ]);
  }

  function Build() : Element {
    return (new Document)
    ->Themes(GetAdaptiveThemes())
    ->Themes(GetGraverTheme())
    ->ThemeParameter(BackgroundColor, Hex("e6e8ea"))
    ->Child(
      (new Dialog)
      ->Title("Создать проект")
      ->OkText("Создать")
      ->CancelText("Отменить")
      ->BackRedirect("HomePage.php")
      ->ToRedirect("CreateProjectPage.php")
      ->Child($this->BuildContent())
    );
  }
}

Node::Run(new CreateProjectPage);