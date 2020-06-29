<?php

require_once(__DIR__ . "/../../libs/include_tree-php.php");
require_once(__DIR__ . "/Space.php");

class CreateProjectCard extends Component
{
  private $Size = "135px";
  private $RedirectLink;

  /// RedirectLink
  function RedirectLink(string $string) {
    $this->RedirectLink = $string;
    return $this;
  }

  /// Size
  function Size(string $string) {
    $this->Size = $string;
    return $this;
  }

  /// Build
  function BuildContent() : Element {
    return Column::Create()
    ->CrossAlign(CrossAxisAligns::Center)
    ->MainAlign(MainAxisAligns::Center)
    ->Children(
      Text::Create()
      ->ThemeKeys("material_icons")
      ->Text("add")
    );
  }

  function Build() : Element {
    return (new Link)
    ->ThemeParameter(TextDecoration, None)
    //->ThemeParameter(Color, Gray)
    ->Link($this->RedirectLink)
    ->Child(
      Container::Create()
      ->ThemeKeys("graver_add_project_button")
      ->ThemeParameter(MinWidth, Px($this->Size / 2))
      ->ThemeParameter(MaxWidth, Px($this->Size / 2))
      ->ThemeParameter(Width, Px($this->Size / 2))
      ->ThemeParameter(MinHeight, $this->Size)
      ->ThemeParameter(MaxHeight, $this->Size)
      ->ThemeParameter(Height, $this->Size)
      ->Child( $this->BuildContent())
    );
  }
}