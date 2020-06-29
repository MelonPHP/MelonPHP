<?php

require_once(__DIR__ . "/../components/include.php");
require_once(__DIR__ . "/../teamples/include.php");
require_once(__DIR__ . "/../elements/include.php");
require_once(__DIR__ . "/../../libs/include_tree-php.php");
require_once(__DIR__ . "/../../backend/include.php");

class CreateProjectPage extends Component
{
  private $Title = "";
  private $Picture = "";
  private $Text = "";
  private $Code = "";
  private $Message = "";

  function Think() {
    if (isset($_POST["title"]))
      $this->Title = $_POST["title"];
    if (isset($_POST["picture"]))
      $this->Picture = $_POST["picture"];
    if (isset($_POST["text"]))
      $this->Text = $_POST["text"];
    if (isset($_POST["code"]))
      $this->Code = $_POST["code"];

    if (empty($this->Title) || empty($this->Picture)
        || empty($this->Text) || empty($this->Code))
      return;

    if ($this->Code != "graver_3214") {
      $this->Message = "Неверный код";
      return;
    }

    $nameMask = "/[^a-zA-Zа-яёА-ЯЁ ]/u";
    if (preg_match($nameMask, $this->Title) || strlen($this->Picture) < 4) {
      $this->Message = "Неправильный формат полей";
      return;
    }

    if (!ArticlesController::GetInstance()->AddArticle(
      $this->Title,
      $this->Picture,
      $this->Text
    ))
      $this->Message = "Не удалось создать статью";
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
      ->Text("Тестовый диалог создания статьи в Graver!"),
      Space::Create(),
      (new TextField)
      ->ThemeKeys("graver_field")
      ->Placeholder("Название статьи")
      ->Text($this->Title)
      ->ActionKey("title"),
      Space::Create(),
      (new TextField)
      ->ThemeKeys("graver_field")
      ->Placeholder("Ссылка на изображение")
      ->Text($this->Picture)
      ->ActionKey("picture"),
      Space::Create(),
      (new TextBox)
      ->ThemeParameter(MaxWidth, Pr(100))
      ->ThemeParameter(MinWidth, Pr(100))
      ->ThemeParameter(MaxHeight, Px(300))
      ->ThemeKeys("graver_field")
      ->Placeholder("Текст")
      ->Text($this->Text)
      ->ActionKey("text"),
      Space::Create(),
      (new TextField)
      ->ThemeKeys("graver_field")
      ->Placeholder("Код")
      ->Text($this->Code)
      ->ActionKey("code"),
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
      ->Title("Создать статью")
      ->OkText("Создать")
      ->CancelText("Отменить")
      ->BackRedirect("HomePage.php")
      ->ToRedirect("CreateArticlePage.php")
      ->Child($this->BuildContent())
    );
  }
}

Node::Run(new CreateProjectPage);