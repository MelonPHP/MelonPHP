<?php

require_once(__DIR__ . "/../components/include.php");
require_once(__DIR__ . "/../themes/include.php");
require_once(__DIR__ . "/../../libs/include_tree-php.php");

class AuthTeample extends Component
{
  private $Child;
  private $Title;

  function __construct(string $title) {
    parent::__construct();
    $this->Child = new Container;
    $this->Title = $title;
  }

  /// Child
  function Child(Node $child) {
    $this->Child = $child;
    return $this;
  }

  function GetChild() : Node {
    return $this->Child;
  }

  /// Build
  function BuildLeft() : Element {
    return Column::Create()
    ->ThemeKeys("graver_left_auth_picture")
    ->CrossAlign(CrossAxisAligns::Center)
    ->MainAlign(MainAxisAligns::Center)
    ->Children(
      Text::Create()
      ->ThemeKeys(["graver_left_auth_title", "graver_auth_title"])
      ->Text("graver")
    );
  }

  function BuildRight() : Element {
    return VerticalScrollView::Create()
    ->ThemeKeys("graver_auth_form_background")
    ->Child(
      Column::Create()
      ->CrossAlign(CrossAxisAligns::Center)
      ->MainAlign(MainAxisAligns::Center)
      ->ThemeParameter(Padding, [
        Px(50),
        Px(25)
      ])
      ->Children(
        Container::Create()
        ->ThemeKeys("on_show_translate")
        ->ThemeParameter(MaxWidth, Px(500))
        ->ThemeParameter(Height, Auto)
        ->Child(
          Column::Create()
          ->Children([
            Text::Create()
            ->ThemeKeys([
              "graver_auth_form_title", 
              "not_tablet", 
              "not_desktop"
            ])
            ->Text("graver"),
            Space::Create()
            ->Spacing(Px(25)),
            $this->Child
          ])
        )
      )
    );
  }

  function Build() : Element {
    return (new Document)
    ->Title($this->Title . ", graver.com")
    ->Themes(GetGraverTheme())
    ->Themes(GetAdaptiveThemes())
    ->Child(
      Stack::Create()
      ->ThemeKeys("graver_page_background")
      ->Children([
        Picture::Create()
        ->Link(Url("https://www.muralswallpaper.com/app/uploads/Green-Tropical-Plant-Wallpaper-Mural-Room-820x532.jpg")) //
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