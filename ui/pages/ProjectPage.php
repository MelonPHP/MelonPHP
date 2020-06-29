<?php

require_once(__DIR__ . "/../components/include.php");
require_once(__DIR__ . "/../teamples/include.php");
require_once(__DIR__ . "/../elements/include.php");
require_once(__DIR__ . "/../../libs/include_tree-php.php");
require_once(__DIR__ . "/../../backend/include.php");

class ProjectPage extends Component
{
  private $ProjectsCount;
  private $Picture;
  private $Name;
  private $ProjectID;
  private $IsFolderSelected;
  private $Splash;
  private $Folders;
  private $FolderID;
  private $Folder;
  private $Tasks;
  private $SplashTaskList;
  private $TaskCount = 0;

  function Think() {
    $this->ProjectID = $_GET["id"];
    
    $this->Splash = !isset($_GET["splash"]) ? true : ($_GET["splash"] == "true" ? true : false);

    $this->SplashTaskList = !isset($_GET["splash_tasks"]) ? true : ($_GET["splash_tasks"] == "true" ? true : false);
    
    $this->ProjectsCount = ProjectsController::GetInstance()->Count($_COOKIE["session_key"]);

    $project = ProjectsController::GetInstance()->GetProject($_COOKIE["session_key"], $_GET["id"]);
    $this->Picture = $project["picture"];
    $this->Name = $project["title"];

    $this->FolderID = !isset($_GET["folder_id"]) ? -1 : $_GET["folder_id"];
    $this->Folders = FolderController::GetInstance()->GetFolders($this->ProjectID);
    $this->IsFolderSelected = $this->FolderID >= 0;

    if ($this->IsFolderSelected) {
      $this->Folder = FolderController::GetInstance()->GetFolder($this->FolderID);
      $this->Tasks = TaskController::GetInstance()->GetTasks($this->Folder["id"]);
    }

    foreach (FolderController::GetInstance()->GetFoldersID($this->ProjectID) as $value) {
      $this->TaskCount += TaskController::GetInstance()->GetTasksCountInFolder($value);
    }
  }

  function __construct() {
    parent::__construct();
    $this->Think();
  }

  function BuildTitleLeft(string $string) {
    return Text::Create()
    ->ThemeParameter(FontSize, Px(22))
    ->ThemeParameter(FontWeight, 500)
    ->ThemeParameter(Padding, [0, Px(17)])
    ->ThemeParameter(Color, Hex("4242429c"))
    ->Text($string);
  }

  function BuildCheckLine(string $icon, string $text, string $link) {
    return Row::Create()
    ->CrossAlign(CrossAxisAligns::Scretch)
    ->ThemeParameter(Height, Px(39))
    ->ThemeParameter(MinHeight, Px(39))
    ->ThemeParameter(MaxHeight, Px(39))
    ->ThemeParameter(PaddingLeft, Px(30))
    ->ThemeKeys("graver_check_line")
    ->ThemeKeys($this->SplashTaskList ? "on_show_x_large_translate" : "")
    ->ThemeParameter(Height, Auto)
    ->Children(
      (new Link)
      ->ThemeParameter(TextDecoration, None)
      ->ThemeKeys("graver_check_line_link")
      ->Link($link)
      ->Child(
        Column::Create()
        ->CrossAlign(CrossAxisAligns::Center)
        ->MainAlign(MainAxisAligns::Center)
        ->Children(
          Text::Create()
          ->ThemeKeys("material_icons")
          ->Text($icon)
        )
      )
    )
    ->Children(
      Container::Create()
      ->ThemeParameter(PaddingLeft, Px(15))
      ->ThemeParameter(PaddingRight, Px(30))
      ->Child(
        HorizontalScrollView::Create()
        ->ThemeParameter(MaxWidth, Pr(100))
        ->ThemeParameter(BorderBottom, [Px(1), Solid, Hex("8080803d")])
        ->ThemeKeys("graver_hide_scrollbar")
        ->Child(
          Column::Create()
          ->ThemeParameter(Height, Px(39))
          ->MainAlign(MainAxisAligns::Center)
          ->Children(
            Text::Create()
            ->ThemeParameter(WhiteSpace, "pre")
            ->Text($text)
          )
        )
      )
    );
  }

  function BuildRightFolder() {
    $column = new Column;
    $i=0;
    foreach ($this->Tasks as $value) {
      $column->Children(
        $this->BuildCheckLine(Icons::RadioButtonChecked, $value["name"], "DeleteTask.php?task_id=".$value["id"]."&project_id=".$this->ProjectID."&folder_id=".$this->FolderID)
        ->ThemeParameter(AnimationDelay, (0.025 * ($i + cos($i) * 2)) ."s")
      );
    }
    $column->Children(
      $this->BuildCheckLine(Icons::Plus, "Добавить", "CreateTasksPage.php?project_id=".$this->ProjectID.($this->FolderID >= 0 ? "&folder_id=".$this->FolderID : ""))
      ->ThemeParameter(AnimationDelay, 0.05 * $i ."s")
    );
    return Stack::Create()
    ->ThemeKeys($this->SplashTaskList ? "on_show_x_large_translate" : "")
    ->Children(
      VerticalScrollView::Create()
      ->ThemeKeys("graver_hide_scrollbar")
      ->ThemeParameter(PaddingTop, Px(98))
      ->Child($column)
    )
    ->Children(
      Column::Create()
      ->ThemeParameter(WebKit(BackdropFilter), Blur(Px(20)))
      ->ThemeParameter(BackdropFilter, Blur(Px(20)))
      ->ThemeParameter(Height, Auto)
      ->Children(
        Space::Create()
        ->Spacing(Px(40)),
      )
      ->Children(
        HorizontalScrollView::Create()
        ->ThemeKeys("graver_hide_scrollbar")
        ->ThemeParameter(Padding, [0, Px(30)])
        ->Child(
          Text::Create()
          ->ThemeParameter(WhiteSpace, "pre")
          ->ThemeParameter(PaddingBottom, Px(30))
          ->ThemeParameter(FontSize, Px(22))
          ->Text($this->Folder["name"])
        )
      )
      ->Children(
        Container::Create()
        ->ThemeParameter(Padding, [0, Px(30)])
        ->Child(
          Separator::Create()
          ->Orientation(Separator::Vertical)
        )
      )
    );
  }

  function BuildTabs() {
    return Column::Create()
    ->ThemeParameter(Height, Auto)
    ->ThemeParameter(Padding, [0, Px(15)])
    ->ThemeParameter(PaddingTop, Px(20))
    ->Children(
      Row::Create()
      ->ThemeParameter(Height, Auto)
      ->ThemeParameter(MaxHeight, Px(60))
      ->Children([
        (new ProjectTile)
        ->Link("ProjectSettingsPage.php?project_id=".$this->ProjectID."&folder_id=".$this->FolderID)
        ->Splash(!$this->Splash)
        ->Title("Настройки")
        ->SubTitle("проекта"),
        Space::Create()
        ->Spacing(Px(10))
        ->Orientation(Space::Horizontal),
        (new ProjectTile)
        ->Link("HomePage.php")
        ->Title("Главная")
        ->Splash(!$this->Splash)
        ->SubTitle($this->ProjectsCount . " проект"),
      ])
    )
    ->Children([
      Space::Create()
      ->Spacing(Px(10)),
      (new ProjectTile)
      ->Splash(!$this->Splash)
      ->Link("ProjectPage.php?splash=false&id=".$this->ProjectID)
      ->Title("Все")
      ->SubTitle($this->TaskCount != 0 ? $this->TaskCount . " задач" : "Все задачи выполнены")
    ]);
  }

  function BuildList() {
    $column = Column::Create()
    ->ThemeParameter(PaddingTop, Px(268));
    $column->Children(
      Space::Create()
      ->Spacing(Px(5))
    );
    foreach ($this->Folders as $value) {
      $column->Children(
        (new ListItem)
        ->Link("ProjectPage.php?splash=false&id=".$this->ProjectID."&folder_id=".$value["id"])
        ->Icon(Icons::FolderOpen)
        ->Prefix(
          Text::Create()
          ->ThemeParameter(PaddingLeft, Px(10))
          ->ThemeParameter(Color, Gray)
          ->ThemeParameter(FontWeight, 300)
          ->Text(TaskController::GetInstance()->GetTasksCountInFolder($value["id"]) . " ")
        )
        ->Title($value["name"])
      );
    }
    $column->Children(
      (new ListItem)
      ->Link("CreateFolderPage.php?project_id=".$this->ProjectID."&folder_id=".$this->FolderID)
      ->Icon(Icons::Plus)
      ->Title("Добавить")
    );
    return VerticalScrollView::Create()
    ->ThemeKeys("graver_hide_scrollbar")
    ->Child($column);
  }

  function BuildLeft() : Element {
    return Container::Create()
    ->ThemeKeys(["graver_project_left", "graver_project"])
    ->Child(
      Stack::Create()
      ->Children(
        Container::Create()
        ->ThemeParameter(WebKit(BackdropFilter), Blur(Px(50)))
        ->ThemeParameter(BackdropFilter, Blur(Px(50)))
        ->ThemeParameter(BackgroundColor, Hex("efefefad"))
      )
      ->Children($this->BuildList())
      ->Children(
        Container::Create()
        ->ThemeParameter(Height, Auto)
        ->ThemeParameter(ZIndex, 2)
        ->Child(
          Column::Create()
          ->ThemeParameter(WebKit(BackdropFilter), Blur(Px(20)))
          ->ThemeParameter(BackdropFilter, Blur(Px(20)))
          ->ThemeParameter(Height, Auto)
          ->Children(
            Space::Create()
            ->Spacing(Px(40)),
          )
          ->Children($this->BuildTitleLeft($this->Name))
          ->Children($this->BuildTabs())
          ->Children(
            Text::Create()
            ->ThemeParameter(Padding, [ Px(20), Px(17) ])
            ->ThemeParameter(FontSize, Px(13))
            ->ThemeParameter(Color, Hex("3e3e3e"))
            ->Text("Папки")
          )
          ->Children(
            Container::Create()
            ->ThemeParameter(Padding, [0, Px(15)])
            ->Child(
              Separator::Create()
              ->Orientation(Separator::Vertical)
            )
          )
        )
      )
    );
  }

  function BuildRight() : Element {
    return Container::Create()
    ->ThemeKeys(["graver_project_right", "graver_project"])
    ->ThemeParameter(BackgroundColor, Hex("e6e8ea"))
    ->Child(
      $this->IsFolderSelected
      ? $this->BuildRightFolder()
      : Column::Create()
        ->ThemeKeys("on_show_x_translate")
        ->MainAlign(MainAxisAligns::Center)
        ->CrossAlign(CrossAxisAligns::Center)
        ->Children($this->BuildTitleLeft("Выберете папку"))
    );
  }

  function Build() : Element {
    return (new Document)
    ->Themes(GetGraverTheme())
    ->Themes(GetAdaptiveThemes())
    ->Themes(GetFontsTheme())
    ->ThemeParameter(BackgroundColor, Hex("e6e8ea"))
    ->Title("Имя проекта, graver.com")
    ->ThemeKeys($this->Splash == true ? "on_show_x_large_translate" : "")
    ->Child(
      Stack::Create()
      ->Children(
        Picture::Create()
        ->Link(Url($this->Picture))
        ->Repeat(PictureRepeats::NoRepeat)
        ->Sizes(PictureSizes::Cover)
      )
      ->Children(
        (new Queue)
        ->Children(
          Row::Create()
          ->ThemeKeys("not_mobile")
          ->Children([
            $this->BuildLeft(),
            Separator::Create(),
            $this->BuildRight()
          ])
        )
        ->Children(
          HorizontalScrollView::Create()
          ->ThemeKeys(["not_desktop", "not_tablet"])
          ->ThemeKeys("graver_hide_scrollbar")
          ->Child(
            Row::Create()
            ->Children([
              $this->BuildLeft(),
              Separator::Create(),
              $this->BuildRight()
            ])
          )
        )
      )
    );
  }
}

Node::Run(new ProjectPage);