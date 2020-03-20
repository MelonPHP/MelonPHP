<?php

require_once("main.php");
require_once("html_layout.php");
require_once("css_constants.php");

class HtmlPicture extends HtmlContainer
{
  private $ImageLink;
  private $ImageRepeat;
  private $ImagePosition;
  private $ImageSize;

  function __construct() {
    parent::__construct();
    $this->ImageLink = Url("https://www.selikoff.net/blog-files/null-value.gif");
  }

  function SetLink(string $string) {
    $this->ImageLink = $string;
    return $this;
  }

  function SetRepeat(string $string) {
    $this->ImageRepeat = $string;
    return $this;
  }

  function SetPosition(string $string) {
    $this->ImagePosition = $string;
    return $this;
  }

  function SetSize(string $string) {
    $this->ImageSize = $string;
    return $this;
  }

  function GetLink() : string {
    return $this->ImageLink;
  }

  function GetRepeat() : string {
    return $this->ImageRepeat;
  }

  function GetPosition() : string {
    return $this->ImagePosition;
  }

  function GetSize() : string {
    return $this->ImageSize;
  }

  private function AddInStyleLink(&$value) {
    $value->AddItem("background-image: ".$this->ImageLink.";");
  }

  private function AddInStyleRepeat(&$value) {
    if ($this->ImageRepeat != null) {
      $value->AddItem("background-repeat: ".$this->ImageRepeat.";");
    }
  }

  private function AddInStylePosition(&$value) {
    if ($this->ImageRepeat != null) {
      $value->AddItem("background-position: ".$this->ImagePosition.";");
    }
  }

  private function AddInStyleSize(&$value) {
    if ($this->ImageRepeat != null) {
      $value->AddItem("background-size: ".$this->ImageSize.";");
    }
  }

  public function Generate() : string {
    $argq = $this->GetArgumentsQueue();
    $isFindStyle = false;
    foreach($argq as &$value) {
      if ($value->GetName() == "style") {
        $isFindStyle = true;
        $this->AddInStyleLink($value);
        $this->AddInStyleRepeat($value);
        $this->AddInStylePosition($value);
        $this->AddInStyleSize($value);
      }
    }
    if (!$isFindStyle) {
      $styleArgument = (new HtmlArgument())
      ->SetName("style");
      $this->AddInStyleLink($value);
      $this->AddInStyleRepeat($value);
      $this->AddInStylePosition($value);
      $this->AddInStyleSize($value);
      $argq->AddItem($styleArgument);
    }
    return (new HtmlTag(
      "div",
      $argq, 
      $this->GetItem()->Generate()
    ))->Generate();
  }
}

class HtmlImage extends HtmlElement
{
  private $LinkArg;

  public function __construct() {
    parent::InitializeHtml();
    $this->LinkArg = (new HtmlArgument)->SetName("src");
  }

  public function SetLink(string $string) {
    $this->LinkArg->RemoveAllItems();
    $this->LinkArg->AddItem($string);
    return $this;
  }

  public function GetLink() {
    return $this->LinkArg->GetItems()[0];
  }

  public function Generate() : string {
    $argq = $this->GetArgumentsQueue();
    array_push($argq, $this->LinkArg);
    return (new HtmlTag(
      "img",
      $argq,
      null
    ))->Generate();
  }
}

?>