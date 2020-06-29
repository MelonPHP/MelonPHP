<?php

require_once(__DIR__ . "/../../libs/include_tree-php.php");
require_once(__DIR__ . "/Space.php");

class Dialog extends Component
{
  private $BackRedirect = "#";
  private $ToRedirect = "#";
  private $Title = "Title";
  private $OkButtonText = ""; 
  private $CancelButtonText = "";
  private $Child = " ";

  /// BackRedirect
  function BackRedirect(string $string) {
    $this->BackRedirect = $string;
    return $this;
  }

  /// ToRedirect
  function ToRedirect(string $string) {
    $this->ToRedirect = $string;
    return $this;
  }

  /// Title
  function Title(string $string) {
    $this->Title = $string;
    return $this;
  }

  /// CancelButtonText
  function CancelText(string $string) {
    $this->CancelButtonText = $string;
    return $this;
  }

  /// PkButtonText
  function OkText(string $string) {
    $this->OkButtonText = $string;
    return $this;
  }

  /// Childs
  function Child($value) {
    $this->Child = is_string($value)
      ? Text::Create()->Text($value)
      : $value;
    return $this;
  }

  /// Build
  function Build() : Element {
    return Column::Create()
    ->CrossAlign(CrossAxisAligns::Center)
    ->MainAlign(MainAxisAligns::Center)
    ->Children(
      (new Action)
      ->Type(ActionTypes::Post)
      ->ThemeKeys("adaptive_dialog")
      ->Redirect($this->ToRedirect)
      ->Child(
        Column::Create()
        ->ThemeKeys("on_show_translate")
        ->MainAlign(MainAxisAligns::Center)
        ->ThemeParameter(BackgroundColor, Hex("f1f1f157"))
        ->ThemeParameter(Padding, [Px(35), Px(25)])
        ->ThemeParameter(BorderRadius, Px(5))
        ->ThemeParameter(Border, [Px(1), Solid, Hex("8c8c8c3b")])
        ->ThemeParameter(BorderTop, [Px(1), Solid, Hex("ffffffe0")])
        ->ThemeParameter(BorderBottom, [Px(1), Solid, Hex("8080808c")])
        ->Children(
          Container::Create()
          ->ThemeParameter(Height, Auto)
          ->Child(
            Column::Create()
            ->ThemeParameter(Height, Auto)
            ->Children([
              Text::Create()
              ->ThemeParameter(FontSize, Px(22))
              ->Text($this->Title),
              Space::Create(),
              $this->Child,
              Space::Create(),
              Row::Create()
              ->Children([
                (new Link)
                ->ThemeKeys("graver_button")
                ->Link($this->BackRedirect)
                ->ThemeParameter(Width, Pr(100))
                ->Child($this->CancelButtonText),
                Space::Create()
                ->Orientation(Space::Horizontal)
                ->Spacing(Px(10)),
                (new Button)
                ->ThemeKeys("graver_button")
                ->ThemeParameter(Width, Pr(100))
                ->Text($this->OkButtonText)
              ])
            ])
          )
        )
      )
    );
  }
}