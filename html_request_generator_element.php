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
    ->AddStyleItem("font-size: 28px;");
  }

  function BuildSubitle() {
    return (new HtmlText())
    ->SetText($this->Subtitle)
    ->AddStyleItem("font-size: 20px;");
  }

  function BuildTable() {
    $table = (new HtmlTable)
    ->AddLine($this->TitleLine)
    ->AddStyleItem("width: 600px;")
    ->AddArgument(
      (new HtmlArgument)
      ->SetName("border")
      ->AddItem("1")
    );
    while ($this->RequestResult->Read()) {
      $line = (new HtmlTableLine);
      foreach ($this->RequestResult->Get() as &$value) {
        $line->AddItem((new HtmlTableItem)
        ->SetItem(
          (new HtmlText)
          ->SetText($value)
        ));
      }
      $table->AddLine($line);
    }
    return $table;
  }

  function Build() {
    return (new HtmlColumn)
    ->AddItem($this->BuildTitle())
    ->AddItem($this->BuildSubitle())
    ->AddItem($this->BuildTable());
  }
}

?>