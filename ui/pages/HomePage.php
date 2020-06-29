<?php

require_once(__DIR__ . "/../components/include.php");
require_once(__DIR__ . "/../teamples/include.php");
require_once(__DIR__ . "/../elements/include.php");
require_once(__DIR__ . "/../../libs/include_tree-php.php");
require_once(__DIR__ . "/../../backend/include.php");

class HomePage extends Component
{
  private $Projects;

  private $Articles;

  function Think() {
    if (!isset($_COOKIE["session_key"]) || !SessionController::GetInstance()->ExistsByKey($_COOKIE["session_key"]))
      Controller::RedirectTo("LoginPage.php");
    
    $this->Projects  = ProjectsController::GetInstance()->GetProjects($_COOKIE["session_key"]);

    $this->Articles = ArticlesController::GetInstance()->GetArticles();
  }

  function __construct() {
    parent::__construct();
    $this->Think();
  }

  function BuildTopText(string $title, string $text) : Column {
    return Column::Create()
    ->Children([
      Text::Create()
      ->ThemeParameter(FontSize, Px(22))
      ->Text($title),
      Space::Create(),
      Text::Create()
      ->ThemeParameter(FontSize, Px(15))
      ->Text($text)
    ]);
  }

  function BuildTopContainer(string $title, string $text) : Element {
    return Container::Create()
    ->ThemeParameter(Padding, [Px(60), Px(40), 0, Px(40)])
    ->ThemeParameter(Height, Auto)
    ->ThemeParameter(BackgroundColor, Hex("e6e8ea96"))
    ->ThemeParameter(BackdropFilter, Blur(Px(30)))
    ->ThemeParameter(WebKit(BackdropFilter), Blur(Px(30)))
    ->Child(
      $this->BuildTopText($title, $text)
      ->Children([
        Space::Create()
        ->Spacing(Px(35)),
        Separator::Create()
        ->Orientation(Separator::Vertical)
      ])
    );
  }

  function BuildTopContainerMobile(string $title, string $text) : Element {
    return Container::Create()
    ->ThemeParameter(Padding, [0, Px(40)])
    ->ThemeParameter(Height, Auto)
    ->ThemeParameter(BackgroundColor, Hex("e6e8ea96"))
    ->ThemeParameter(BackdropFilter, Blur(Px(30)))
    ->ThemeParameter(WebKit(BackdropFilter), Blur(Px(30)))
    ->Child(
      Column::Create()
      ->Children([
        Separator::Create()
        ->Orientation(Separator::Vertical),
        Space::Create()
        ->Spacing(Px(60)),
        $this->BuildTopText($title, $text),
        Space::Create()
        ->Spacing(Px(30)),
        Separator::Create()
        ->Orientation(Separator::Vertical)
      ])
    );
  }

  function BuildProjectsMobile() : Element {
    return Stack::Create()
    ->ThemeParameter(MinHeight, Pr(100.1))
    ->Children([
      VerticalScrollView::Create()
      ->ThemeKeys("graver_hide_scrollbar")
      ->ThemeParameter(Padding, [Px(190), Px(40), 0, Px(40)])
      ->Child(
        (new Builder)
        ->Function(function ($args) {
          $queue = (new Grid)
          ->ThemeParameter(Height, Auto)
          ->ThemeParameter(JustifyContent, Center)
          ->Spacing(Px(20))
          ->ColumnTeample(Repeat("auto-fill", Minmax(Px(120), Px(120))));
          $i = 0;
          foreach ($this->Projects as $value) {
            $queue->Children(
              (new ProjectCard)
              ->Title($value["title"])
              ->PictureLink(Url($value["picture"]))
              ->RedirectLink("ProjectPage.php?id=" . $value["id"])
              ->Size(Px(120))
            );
            ++$i;
          }
          $queue->Children(
            (new CreateProjectCard)
            ->RedirectLink("CreateProjectPage.php")
          );
          return $queue;
        })
      ),
      $this->BuildTopContainerMobile(
        "Проекты",
        "Над чем вы хотели бы поработать сегодня?"
      ),
    ]);
  }

  function BuildArticlesMobile() : Element {
    return Column::Create()
    ->ThemeParameter(Height, Auto)
    ->Children([
      $this->BuildTopText(
        "Статьи",
        "Прочитайте статьи которые помогут вам оптимизировать Ваш день"
      )
      ->ThemeParameter(Padding, [Px(60), Px(40), 0, Px(40)]),
      Column::Create()
      ->Children([
        HorizontalScrollView::Create()
        ->ThemeParameter(PaddingBottom, [Px(60)])
        ->ThemeParameter(PaddingTop, [Px(45)])
        //->ThemeKeys("graver_hide_scrollbar")
        ->Child(
          (new Builder)
          ->Function(function ($args) {
            $queue = Row::Create();
            $i = 0;
            $queue->Children(
              Space::Create()
              ->Spacing(Px(40))
              ->Orientation(Space::Horizontal)
            );
            foreach ($this->Articles as $value) {
              $queue->Children([
                (new ArticleCard)
                ->ImageHeight(Px(150))
                ->Title($value["title"])
                ->PictureLink(Url($value["picture"]))
                ->RedirectLink("ArticlePage.php?text_id=".$value["id"]."&title=".$value["title"]."&picture=".$value["picture"])
                ->ThemeParameter(Width, [Px(350)])
                ->ThemeParameter(MaxWidth, [Px(350)])
                ->ThemeParameter(MinWidth, [Px(350)])
                ->ThemeKeys($i < 5 ? "on_show_x_large_translate" : "nonefd")
                ->ThemeParameter(AnimationDelay, (0.15 * $i)."s")
                ->ThemeParameter(AnimationDuration, "0.15s"),
                Space::Create()
                ->Orientation(Space::Horizontal)
                ->Spacing(Px(15))
              ]);
              ++$i;
            }
            $queue->Children(
              Space::Create()
              ->Spacing(Px(25))
              ->Orientation(Space::Horizontal)
            );
            return $queue;
          })
        ),
      ]),
    ]);
  }

  function BuildMobile() : Element {
    return VerticalScrollView::Create()
    ->Child(
      Column::Create()
      ->Children([
        $this->BuildArticlesMobile(),
        $this->BuildProjectsMobile()
        ->ID("projects")
      ])
    );
  }

  function BuildProjectsDesktop() : Element {
    return Stack::Create()
    ->Children([
      VerticalScrollView::Create()
      ->ThemeKeys("graver_hide_scrollbar")
      ->ThemeParameter(Padding, [Px(190), Px(41), 0, Px(41)])
      ->Child(
        (new Builder)
        ->Function(function ($args) {
          $queue = (new Grid)
          ->ThemeParameter(Height, Auto)
          ->ThemeParameter(JustifyContent, Center)
          ->Spacing(Px(20))
          ->ColumnTeample(Repeat("auto-fill", Minmax(Px(13), Px(135))))
          ->ThemeParameter(PaddingBottom, Px(20));
          $i = 0;
          $anim_speed = 1;
          foreach ($this->Projects as $value) {
            $anim_delta = (0.1 * ($i * $anim_speed));
            $queue->Children(
              (new ProjectCard)
              ->Title($value["title"])
              ->PictureLink(Url($value["picture"]))
              ->RedirectLink("ProjectPage.php?id=" . $value["id"])
              ->ThemeKeys("on_show_x_translate")
              ->ThemeParameter(AnimationDelay, $anim_delta > 0 ? $anim_delta."s" : "0s")
            );
            $anim_speed -= 0.015;
            ++$i;
          }
          $queue->Children(
            (new CreateProjectCard)
            ->RedirectLink("CreateProjectPage.php")
          );
          return $queue;
        })
      ),
      $this->BuildTopContainer(
        "Проекты",
        "Над чем вы хотели бы поработать сегодня?"
      )
    ]);
  }

  function BuildArticlesDesktop() : Element {
    return Stack::Create()
    ->Children([
      VerticalScrollView::Create()
      ->ThemeKeys("graver_hide_scrollbar")
      ->ThemeParameter(Padding, [Px(190), Px(50), 0, Px(50)])
      ->Child(
        (new Builder)
        ->Function(function ($args) {
          $queue = Column::Create();
          $i = 0;
          foreach ($this->Articles as $value) {
            $queue->Children([
              (new ArticleCard)
              ->Title($value["title"])
              ->PictureLink(Url($value["picture"]))
              ->RedirectLink("ArticlePage.php?text_id=".$value["id"]."&title=".$value["title"]."&picture=".$value["picture"])
              ->ThemeKeys("on_show_x_large_translate")
              ->ThemeParameter(AnimationDelay, (0.2 * $i + 0.4)."s")
              ->ThemeParameter(AnimationDuration, "0.2s"),
              Space::Create()
            ]);
            ++$i;
          }
          return $queue;
        })
      ),
      $this->BuildTopContainer(
        "Статьи",
        "Прочитайте статьи которые помогут вам оптимизировать Ваш день"
      )
    ]);
  }

  function BuildDesktop() : Element {
    return Row::Create()
    ->Children([
      $this->BuildProjectsDesktop(),
      Separator::Create()
      ->Orientation(Separator::Horizontal),
      $this->BuildArticlesDesktop()
    ]);
  }

  function Build() : Element {
    return (new Document)
    ->Themes(GetGraverTheme())
    ->Themes(GetAdaptiveThemes())
    ->Themes(GetFontsTheme())
    ->ThemeParameter(BackgroundColor, Hex("e6e8ea"))
    ->Title("Главная, graver.com")
    ->Child(
      (new Queue)
      ->Children([
        $this->BuildDesktop()
        ->ThemeKeys(["not_mobile"]),
        $this->BuildMobile()
        ->ThemeKeys(["not_desktop", "not_tablet"])
      ])
    );
  }
}

Node::Run(new HomePage);