<?php

require_once(__DIR__ . "/../../libs/include_tree-php.php");

class Separator extends Component
{
  const Horizontal = true;
  const Vertical = false;

  private $Orientation = Separator::Horizontal;

  // Orientation
  function Orientation(bool $orientation) {
    $this->Orientation = $orientation;
    return $this;
  }

  function GetOrientation() : bool {
    return $this->Orientation;
  }

  function Build() : Element {
    $cont = Container::Create()
    ->ThemeParameter(BackgroundColor, Hex("bababa"));
    if ($this->Orientation) {
      $cont->ThemeParameter(Width, Px(1));
      $cont->ThemeParameter(MaxWidth, Px(1));
      $cont->ThemeParameter(MinWidth, Px(1));
    }
    else {
      $cont->ThemeParameter(Height, Px(1));
      $cont->ThemeParameter(MaxHeight, Px(1));
      $cont->ThemeParameter(MinHeight, Px(1));
    }
    return $cont;
  }
}