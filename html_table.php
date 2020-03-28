<?php

require_once("html_core.php");

class HtmlTable extends HtmlElement
{
  private $ItemsQueue;

  public function __construct() {
    $this->InitializeHtml();
    $this->ItemsQueue = new HtmlQueue;
  }

  public function AddLine(HtmlTableLine $line) {
    $this->ItemsQueue->AddChild($line);
    return $this;
  }

  public function Generate() : string {
    return (new HtmlTag(
      "table",
      $this->GetArgumentsQueue(),
      $this->ItemsQueue->Generate()
    ))->Generate();
  }
}

class HtmlTableLine extends HtmlElement
{
  private $ItemsQueue;

  public function __construct() {
    $this->InitializeHtml();
    $this->ItemsQueue = new HtmlQueue;
  }

  public function AddChild(HtmlTableItem $line) {
    $this->ItemsQueue->AddChild($line);
    return $this;
  }

  public function GetChilds() : array {
    return $this->ItemsQueue->GetChilds();
  }

  public function Generate() : string {
    return (new HtmlTag(
      "tr",
      $this->GetArgumentsQueue(),
      $this->ItemsQueue->Generate()
    ))->Generate();
  }
}

class HtmlTableItem extends HtmlElement
{
  private $Item;

  public function __construct() {
    $this->InitializeHtml();
  }
  
  public function SetChild(Html $item) {
      $this->Item = $item;
      return $this;
  }

  public function GetChild() : Html {
    return $this->Item;
  }

  public function Generate() : string {
    return (new HtmlTag(
      "td",
      $this->GetArgumentsQueue(),
      $this->Item->Generate()
    ))->Generate();
  }
}

?>