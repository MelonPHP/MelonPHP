<?php

require_once(__DIR__ . "/../../libs/include_tree-php.php");

class Space extends Component
{
  const Horizontal = true;
  const Vertical = false;

  private $Space = "15px";
  private $Orientation = Space::Vertical;

  // Orientation
  function Orientation(bool $orientation) {
    $this->Orientation = $orientation;
    return $this;
  }

  function GetOrientation() : bool {
    return $this->Orientation;
  }

  // Space
  function Spacing(string $string) {
    $this->Space = $string;
    return $this;
  }

  function GetSpace() : string {
    return $this->Space;
  }

  function Build() : Element {
    $cont = Container::Create();
    if ($this->Orientation) {
      $cont->ThemeParameter(Width, $this->Space);
      $cont->ThemeParameter(MaxWidth, $this->Space);
      $cont->ThemeParameter(MinWidth, $this->Space);
    }
    else {
      $cont->ThemeParameter(Height, $this->Space);
      $cont->ThemeParameter(MaxHeight, $this->Space);
      $cont->ThemeParameter(MinHeight, $this->Space);
    }
    return $cont;
  }
}