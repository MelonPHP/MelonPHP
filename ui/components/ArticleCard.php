<?php

require_once(__DIR__ . "/../../libs/include_tree-php.php");
require_once(__DIR__ . "/Space.php");

class ArticleCard extends Component
{
  private $PictureLink;
  private $RedirectLink;
  private $Title;
  private $ImageHeight = "225px";
  
  /// Title
  function Title(string $string) {
    $this->Title = $string;
    return $this;
  }

  /// RedirectLink
  function RedirectLink(string $string) {
    $this->RedirectLink = $string;
    return $this;
  }

  /// RedirectLink
  function PictureLink(string $string) {
    $this->PictureLink = $string;
    return $this;
  }

  /// ImageHeight
  function ImageHeight(string $string) {
    $this->ImageHeight = $string;
    return $this;
  }

  /// Build
  function BuildPicture() : Element {
    return Picture::Create()
    ->ThemeParameter(BorderBottom, [Px(1), Solid, Hex("8484849e")])
    ->ThemeParameter(Height, $this->ImageHeight)
    ->ThemeParameter(BorderRadius, Px(5))
    ->Positions(PicturePositions::Center)
    ->Repeat(PictureRepeats::NoRepeat)
    ->Sizes(PictureSizes::Cover)
    ->Link($this->PictureLink);
  }

  function BuildBottom() : Element {
    return Row::Create()
    ->ThemeParameter(Padding, [Px(15), Px(30)])
    ->ThemeParameter(Height, Auto)
    ->CrossAlign(CrossAxisAligns::Center)
    ->Children(
      Text::Create()
      ->ThemeParameter(FontSize, Px(16))
      ->ThemeParameter(Width, Pr(100))
      ->Text($this->Title)
    )
    ->Children(
      (new Link)
      ->Link($this->RedirectLink)
      ->Child(
        (new Button)
        ->ThemeParameter(Width, Auto)
        ->ThemeKeys("on_show_x_translate")
        ->ThemeParameter(AnimationDelay, "0.2s")
        ->ThemeKeys("graver_button")
        ->Text("Читать")
      )
    );
  }

  function Build() : Element {
    return Container::Create()
    ->ThemeParameter(Height, Auto)
    ->ThemeParameter(BorderRadius, Px(5))
    ->ThemeParameter(Border, [Px(1), Solid, Hex("8c8c8c3b")])
    ->ThemeParameter(BorderTop, [Px(1), Solid, Hex("ffffffe0")])
    ->ThemeParameter(BorderBottom, [Px(1), Solid, Hex("8080808c")])
    ->Child(
      Picture::Create()
      ->ThemeParameter(BorderRadius, Px(5))
      ->Positions(PicturePositions::Center)
      ->Repeat(PictureRepeats::NoRepeat)
      ->Sizes(PictureSizes::Cover)
      ->Link($this->PictureLink)
      ->Child(
        Column::Create()
        ->ThemeParameter(Height, Auto)
        ->ThemeParameter(BorderRadius, Px(5))
        ->ThemeKeys("graver_auth_form_background")
        ->Children($this->BuildPicture())
        ->Children($this->BuildBottom())
      )
    );
  }
}