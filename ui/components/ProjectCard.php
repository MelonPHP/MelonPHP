<?php

require_once(__DIR__ . "/../../libs/include_tree-php.php");
require_once(__DIR__ . "/Space.php");

class ProjectCard extends Component
{
  private $Size = "135px";
  private $PictureLink;
  private $RedirectLink;
  private $Title;
  
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

  /// Size
  function Size(string $string) {
    $this->Size = $string;
    return $this;
  }

  /// Build
  function BuildContent() : Element {
    return Picture::Create()
    ->Positions(PicturePositions::Center)
    ->Repeat(PictureRepeats::NoRepeat)
    ->Sizes(PictureSizes::Cover)
    ->Link($this->PictureLink)
    ->Child(
      Column::Create()
      ->MainAlign(MainAxisAligns::Center)
      ->CrossAlign(CrossAxisAligns::Center)
      ->ThemeParameter(Padding, Px(10))
      ->Children(
        Text::Create()
        ->ThemeKeys("on_show_x_translate")
        ->ThemeParameter(AnimationDelay, "0.2s")
        ->ThemeParameter(FontSize, Px(32))
        ->Text(mb_substr($this->Title, 0, 1))
      )
      ->Children(
        Text::Create()
        ->ThemeKeys("on_show_x_translate")
        ->ThemeParameter(AnimationDelay, "0.4s")
        ->ThemeParameter(FontWeight, 300)
        ->Text($this->Title)
      )
    );
  }

  function Build() : Element {
    return (new Link)
    ->ThemeParameter(TextDecoration, None)
    ->ThemeParameter(Color, Black)
    ->Link($this->RedirectLink)
    ->Child(
      Container::Create()
      ->ThemeParameter(MinWidth, $this->Size)
      ->ThemeParameter(MaxWidth, $this->Size)
      ->ThemeParameter(Width, $this->Size)
      ->ThemeParameter(MinHeight, $this->Size)
      ->ThemeParameter(MaxHeight, $this->Size)
      ->ThemeParameter(Height, $this->Size)
      ->ThemeKeys("graver_project_card")
      //->ThemeParameter(Padding, Px(5))
      ->Child($this->BuildContent())
    );
  }
}