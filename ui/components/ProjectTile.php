<?php

require_once(__DIR__ . "/../../libs/include_tree-php.php");

class ProjectTile extends Component
{
  private $Link;
  private $Title;
  private $SubTitle;
  private $Splash;

  function Link(string $string) {
    $this->Link = $string;
    return $this;
  }

  function Splash(bool $string) {
    $this->Splash = $string;
    return $this;
  }

  function Title(string $string) {
    $this->Title = $string;
    return $this;
  }

  function SubTitle(string $string) {
    $this->SubTitle = $string;
    return $this;
  }

  function Build() : Element {
    return (new Link)
    ->Link($this->Link)
    ->ThemeKeys($this->Splash == false ? "on_show_x_translate" : "")
    ->ThemeParameter(AnimationDuration, "0.45s")
    ->ThemeParameter(Width, Pr(100))
    ->ThemeParameter(Height, Px(60))
    ->ThemeKeys("graver_button")
    ->Child(
      Column::Create()
      ->Children(
        Text::Create()
        ->ThemeKeys($this->Splash == false ? "on_show_x_translate" : "")
        ->ThemeParameter(AnimationDuration, "0.45s")
        ->ThemeParameter(AnimationDelay, "0.25s")
        ->ThemeParameter(PaddingTop, Px(3))
        ->ThemeParameter(Color, Black)
        ->Text($this->Title)
      )
      ->Children(
        Text::Create()
        ->ThemeKeys($this->Splash == false ? "on_show_x_translate" : "")
        ->ThemeParameter(AnimationDuration, "0.45s")
        ->ThemeParameter(AnimationDelay, "0.35s")
        ->ThemeParameter(FontWeight, 500)
        ->ThemeParameter(FontSize, Px(12))
        ->ThemeParameter(Color, Gray)
        ->Text($this->SubTitle)
      )
    );
  }
}