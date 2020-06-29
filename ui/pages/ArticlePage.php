<?php

require_once(__DIR__ . "/../components/include.php");
require_once(__DIR__ . "/../teamples/include.php");
require_once(__DIR__ . "/../elements/include.php");
require_once(__DIR__ . "/../../libs/include_tree-php.php");
require_once(__DIR__ . "/../../backend/include.php");

class ArticlePage extends Component
{
  private $Title;
  private $Text;
  private $Picture;

  function AddMarckdown(string $string, string $finder, string $left, string $right) : string {
    $text = "";
    $isFind = false;
    $array = preg_split('//u', $string, null, PREG_SPLIT_NO_EMPTY);;
    foreach ($array as $value) {
      if ($value == $finder) {
        $text .= $isFind ? $right : $left;
        $isFind = !$isFind;
      }
      else
        $text .= $value;
    }
    return $text;
  }
  
  function Think() {
    $this->Title = $_GET["title"];
    $this->Picture = $_GET["picture"];
    $text = ArticlesController::GetInstance()->GetTextById($_GET["text_id"]);
    $text = $this->AddMarckdown($text, "_", "<b>", "</b>");
    $text = $this->AddMarckdown($text, "*", "<i>", "</i>");
    $textArray = explode("\n", $text);

    $this->Text = new Queue;
    foreach ($textArray as $value) {
      if (strlen($value) >= 2 && $value[0] == "#" && $value[1] == " ")
        $this->Text->Children(
          Text::Create()
          ->ThemeParameter(FontSize, Px(19))
          ->Text(substr($value, 2))
        );
      else
        $this->Text->Children(
          Text::Create()
          ->Text($value)
        );
      $this->Text->Children(
        Space::Create()
      );
    }
  }

  function __construct() {
    parent::__construct();
    $this->Think();
  }

  /// Build
  function BuildLeft() : Element {
    return Container::Create();
  }

  function BuildRight() : Element {
    return Container::Create()
    ->Child(
      Stack::Create()
      ->Children(
        VerticalScrollView::Create()
        ->ThemeParameter(BackgroundColor, Hex("f1f1f1e3"))
        ->ThemeParameter(BackdropFilter, Blur(Px(30)))
        ->ThemeParameter(WebKit(BackdropFilter), Blur(Px(30)))
        ->ThemeKeys("graver_hide_scrollbar")
        ->Child(
          Column::Create()
          ->ThemeKeys("on_show_x_large_translate")
          ->ThemeParameter(Padding, [Px(230), Px(40), Px(40), Px(40)])
          ->ThemeParameter(AnimationDelay, "0.4s")
          ->Children($this->Text)
        )
      )
      ->Children([
        Container::Create()
        ->ThemeParameter(BackdropFilter, Blur(Px(30)))
        ->ThemeParameter(WebKit(BackdropFilter), Blur(Px(30)))
        ->ThemeParameter(ZIndex, 3)
        ->ThemeParameter(Height, Auto)
        ->ThemeParameter(Padding, [Px(60), Px(40), 0, Px(40)])
        ->Child(
          Column::Create()
          ->Children(
            Row::Create()
            ->ThemeKeys("on_show_x_translate")
            ->ThemeParameter(AnimationDuration, "0.3s")
            ->CrossAlign(CrossAxisAligns::Center)
            ->Children(
              Text::Create()
              ->ThemeParameter(FontSize, Px(22))
              ->ThemeParameter(Width, Pr(100))
              ->Text($this->Title)
            )
            ->Children(
              Space::Create()
              ->Orientation(Space::Vertical)
              ->Spacing(Px(7))
            )
            ->Children(
              (new Link)
              ->Link("HomePage.php")
              ->Child(
                (new Button)
                ->ThemeKeys("on_show_x_translate")
                ->ThemeParameter(AnimationDelay, "0.3s")
                ->ThemeParameter(Width, Auto)
                ->ThemeKeys("graver_button")
                ->Text("Прочитал")
              )
            )
          )
          ->Children([
            Space::Create()
            ->Spacing(Px(35)),
            Separator::Create()
            ->Orientation(Separator::Vertical)
          ])
        )
      ])
    );
  }

  function Build() : Element {
    return (new Document)
    ->Title("Статья: ".$this->Title . ", graver.com")
    ->Themes(GetGraverTheme())
    ->Themes(GetAdaptiveThemes())
    ->Child(
      Stack::Create()
      ->ThemeKeys("graver_page_background")
      ->Children([
        Picture::Create()
        ->Link(Url($this->Picture))
        ->Repeat(PictureRepeats::NoRepeat)
        ->Sizes(PictureSizes::Cover),
        Row::Create()
        ->Children([
          $this->BuildLeft()
          ->ThemeKeys("not_mobile"),
          Separator::Create()
          ->ThemeKeys("not_mobile"),
          $this->BuildRight()
        ])
      ])
    );
  }
}

Node::Run((new ArticlePage)->Build());