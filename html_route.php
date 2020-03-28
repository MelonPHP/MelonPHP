<?php

require_once("html_core.php");

class HtmlLink extends HtmlElement
{
  private $Item;
  private $LinkArg;

  public function __construct() {
    parent::InitializeHtml();
    $this->LinkArg = (new HtmlArgument)->SetName("href");
  }

  public function SetChild(Html $item) {
    $this->Item = $item;
    return $this;
  }

  public function GetChild() : Html {
    return $this->Item;
  }

  public function SetLink(string $string) {
    $this->LinkArg->RemoveAllItems();
    $this->LinkArg->AddChild($string);
    return $this;
  }

  public function GetLink() {
    return $this->LinkArg->GetChilds()[0];
  }

  public function Generate() : string {
    $argq = $this->GetArgumentsQueue();
    array_push($argq, $this->LinkArg);
    return (new HtmlTag(
      "a",
      $argq,
      $this->Item->Generate()
    ))->Generate();
  }
}

?>