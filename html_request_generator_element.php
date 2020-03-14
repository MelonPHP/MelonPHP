<?php

require_once("html/html.php");
require_once("databace/databace_context.php");

class HtmlTableRequestGeneratorElement extends HtmlElement {

  private $Title;
  private $Subtitle;
  private $TitleLine;
  private $RequestResult;

  public function SetTitle($string) {
    $this->Title = $string;
    return $this;
  }

  public function SetSubtitle($string) {
    $this->Subtitle = $string;
    return $this;
  }

  public function SetTitleLine($item) {
    $this->TitleLine = $item;
    return $this;
  }

  public function SetRequestResult($item) {
    $this->RequestResult = $item;
    return $this;
  }

  function BuildTitle() {
    return (new HtmlText())
    ->SetText($this->Title)
    ->AddStyleItem("font-size: 28px");
  }

  function BuildSubitle() {
    return (new HtmlText())
    ->SetText($this->Subtitle)
    ->AddStyleItem("font-size: 20px");
  }

  function BuildTable() {
    if ($this->RequestResult->IsCan()) {
      $this->TitleLine
      ->AddStyleItem("height: 50px")
      ->AddStyleItem("font-weight: bold")
      ->AddStyleItem("background-color: white");
      $table = (new HtmlTable)
      ->AddLine($this->TitleLine)
      ->AddStyleItem("border-collapse: collapse")
      ->AddStyleItem("width: 100%");
      $yo = true;
      while ($this->RequestResult->Read()) {
        $line = (new HtmlTableLine)
        ->AddStyleItem("height: 40px")
        ->AddStyleItem($yo ? "background-color: #fafafa" : "background-color: white");
        foreach ($this->RequestResult->Get() as &$value) {
          $line->AddItem((new HtmlTableItem)
          ->AddStyleItem("padding : 0 10px")
          ->SetItem(
            (new HtmlText)
            ->SetText($value)
          ));
        }
        $yo = !$yo;
        $table->AddLine($line);
      }
      return (new HtmlVertivalScroll)
      ->AddStyleItem("height: 200px")
      ->SetItem($table);
    }
    else
      return (new HtmlText)->SetText("Connect error");
  }

  function BuildSpace($height) {
    return (new HtmlContainer)
    ->SetChild(new HtmlNullable)
    ->AddStyleItem("height : ".$height."px");
  }

  function Build() {
    return (new HtmlColumn)
    ->AddStyleItem("margin : 30px 0")
    ->AddStyleItem("border-radius : 3px")
    ->AddStyleItem("padding : 30px 25px")
    ->AddStyleItem("background-color : white")
    ->AddStyleItem("box-shadow : 0 1.6px 3.6px 0 rgba(0,0,0,0.132), 0 0.3px 0.9px 0 rgba(0,0,0,0.108)")
    ->AddItem($this->BuildTitle())
    ->AddItem($this->BuildSpace(10))
    ->AddItem($this->BuildSubitle())
    ->AddItem($this->BuildSpace(20))
    ->AddItem($this->BuildTable());
  }
}

?>