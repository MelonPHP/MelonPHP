<?php

require_once(__DIR__ . "/../Includes/Core.php");
require_once(__DIR__ . "/../Includes/Styles.php");
require_once(__DIR__ . "/Container.php");
require_once(__DIR__ . "/Tag.php");
require_once(__DIR__ . "/PictureRepeats.php");

class Picture extends Container 
{
  private $Link;
  private $Repeat;
  private $Positions;
  private $Sizes;

  function __construct() {
    parent::__construct();

    $this->Positions = new Queue;
    $this->Sizes = new Queue;

    $this->SetLink(Url("https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Icon_None.svg/768px-Icon_None.svg.png"));
    $this->SetRepeat(PictureRepeats::NoRepeat);
    $this->SetPosition(PicturePositions::Center);
    $this->SetSize(PictureSizes::Contain);
  }

  /// Link
  function SetLink(string $string) {
    $this->Link = $string;
    return $this;
  }
  
  function GetLink() : string {
    return $this->Link;
  }

  /// Repeat
  function SetRepeat(string $string) {
    $this->Repeat = $string;
    return $this;
  }

  function GetRepeat() : string {
    return $this->Repeat;
  }

  /// Position
  function SetPositions(string $x, string $y) {
    $this->Positions->SetChilds([$x, $y]);
    return $this;
  }

  function SetPosition(string $position) {
    $this->Positions->SetChilds([$position]);
    return $this;
  }

  function GetPositions() : array {
    return $this->Positions->GetChilds();
  }

  /// Size
  function SetSizes(string $w, string $h) {
    $this->Sizes->SetChilds([$w, $h]);
    return $this;
  }

  function SetSize(string $size) {
    $this->Sizes->SetChilds([$size]);
    return $this;
  }

  function GetSize() : array {
    return $this->Sizes->GetChilds();
  }

  /// Generate
  function GetArguments() : Queue {
    $args = parent::GetArguments()->GetChilds();
    foreach ($args as &$arg) {
      if ($arg->GetName() === "style") {
        $totalQ = (new Queue)
        ->SetLeftPrefix(" ")
        ->SetRightPrefix(";");
        if (!empty($this->Link))
          $totalQ->AddChild(
            (new ThemeParameter)
            ->SetName(BackgroundImage)
            ->SetValue($this->Link)
            ->Generate()
          );
        if (!empty($this->Repeat))
          $totalQ->AddChild(
            (new ThemeParameter)
            ->SetName(BackgroundRepeat)
            ->SetValue($this->Repeat)
            ->Generate()
          );
        if (!empty($this->Positions))
          $totalQ->AddChild(
            (new ThemeParameter)
            ->SetName(BackgroundPosition)
            ->SetValue(SpaceLine($this->Positions->GetChilds()))
            ->Generate()
          );
        if (!empty($this->Positions))
          $totalQ->AddChild(
            (new ThemeParameter)
            ->SetName(BackgroundSize)
            ->SetValue(SpaceLine($this->Sizes->GetChilds()))
            ->Generate()
          );
        $arg->SetValue(
          $arg->GetValue()
          .$totalQ->Generate()
        );
        break;
      }
    } 
    return (new Queue)
    ->SetChilds($args);
  }

  function Generate() : string {
    return (new Tag)
    ->SetName("div")
    ->AddArguments($this->GetArguments()->GetChilds())
    ->SetChild($this->GetChild())
    ->Generate();
  }
}