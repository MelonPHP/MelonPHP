<?php

require_once(__DIR__ . "/../../libs/include_tree-php.php");
require_once(__DIR__ . "/../themes/include.php");

class ListItem extends Component
{
  private $Title;
  private $Prefix;
  private $Link;
  private $Icon = Icons::List;

  function Link(string $string) {
    $this->Link = $string;
    return $this;
  }

  function Prefix(Node $string) {
    $this->Prefix = $string;
    return $this;
  }

  function Icon(string $string) {
    $this->Icon = $string;
    return $this;
  }

  function Title(string $string) {
    $this->Title = $string;
    return $this;
  }

  function BuildsContent() {
    return Row::Create()
    ->CrossAlign(CrossAxisAligns::Center)
    ->ThemeParameter(Padding, [Px(9), Px(20)])
    ->Children(
      Text::Create()
      ->ThemeKeys("material_icons")
      ->ThemeParameter(Color, Hex("4242429c"))
      ->ThemeParameter(PaddingRight, Px(10))
      ->Text($this->Icon)
    )
    ->Children(
      HorizontalScrollView::Create()
      ->ThemeKeys("graver_hide_scrollbar")
      ->Child(
        Column::Create()
        ->MainAlign(MainAxisAligns::Center)
        ->Children(
          Text::Create()
          ->ThemeParameter(WhiteSpace, "pre")
          ->ThemeParameter(Width, Pr(100))
          ->ThemeParameter(Color, Black)
          ->Text($this->Title)
        )
      )
    )
    ->Children(
      $this->Prefix == null ? new COntainer : $this->Prefix
    );
  }

  function Build() : Element {
    return $this->Link != "" 
    ? (new Link)
      ->ThemeKeys("graver_list_item")
      ->ThemeParameter(Width, Pr(100))
      ->ThemeParameter(TextDecoration, None)
      ->Link($this->Link)
      ->Child( $this->BuildsContent() )
    : Container::Create()
      ->ThemeKeys("graver_list_item")
      ->ThemeParameter(Width, Pr(100))
      ->ThemeParameter(TextDecoration, None)
      ->Child($this->BuildsContent());
  }
}