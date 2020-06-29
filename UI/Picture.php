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

    $this->Link(Url("https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Icon_None.svg/768px-Icon_None.svg.png"));
    $this->Repeat(PictureRepeats::NoRepeat);
  }

  /// Link
  function Link(string $string) {
    $this->Link = $string;
    return $this;
  }
  
  function GetLink() : string {
    return $this->Link;
  }

  /// Repeat
  function Repeat(string $string) {
    $this->Repeat = $string;
    return $this;
  }

  function GetRepeat() : string {
    return $this->Repeat;
  }

  /// Position
  function Positions($values) {
    $this->Positions->Children($values);
    return $this;
  }

  function GetPositions() : array {
    return $this->Positions->GetChildren();
  }

  /// Size
  function Sizes($values) {
    $this->Sizes->Children($values);
    return $this;
  }

  function GetSize() : array {
    return $this->Sizes->GetChildren();
  }

  /// Generate
  function GetArguments() : Queue {
    $args = parent::GetArguments()->GetChildren();
    foreach ($args as &$arg) {
      if ($arg->GetName() === "style") {
        $totalQ = Queue::Create()
        ->LeftPrefix(" ")
        ->RightPrefix(";");
        if (!empty($this->Link))
          $totalQ->Children([
            (new ThemeParameter)
            ->Name(BackgroundImage)
            ->Value($this->Link)
            ->Generate()
          ]);
        if (!empty($this->Repeat))
          $totalQ->Children([
            (new ThemeParameter)
            ->Name(BackgroundRepeat)
            ->Value($this->Repeat)
            ->Generate()
          ]);
        if (!empty($this->Positions))
          $totalQ->Children([
            (new ThemeParameter)
            ->Name(BackgroundPosition)
            ->Value(SpaceLine($this->Positions->GetChildren()))
            ->Generate()
          ]);
        if (!empty($this->Positions))
          $totalQ->Children([
            (new ThemeParameter)
            ->Name(BackgroundSize)
            ->Value(SpaceLine($this->Sizes->GetChildren()))
            ->Generate()
          ]);
        $arg->Value(
          $arg->GetValue()
          .$totalQ->Generate()
        );
        break;
      }
    } 
    return (new Queue)
    ->Children($args);
  }

  function Generate() : string {
    return Tag::Create()
    ->Name("div")
    ->Arguments($this->GetArguments()->GetChildren())
    ->Child($this->GetChild())
    ->Generate();
  }
}