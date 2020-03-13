<?php

require_once("html_core.php");

class HtmlLink extends HtmlComponent
{
  private $Item;
  private $LinkArg;

  public function __construct() {
    parent::__construct();
    $this->LinkArg = (new HtmlArgument)->SetName("href");
  }

  public function SetItem($item) {
    $this->Item = $item;
    return $this;
  }

  public function SetLink($string) {
    $this->LinkArg->ClearItemQuery();
    $this->LinkArg->AddItem($string);
    return $this;
  }

  public function Generate() {
    $arg = $this->LinkArg->Generate();
    if ($this->LinkArg->IsEmpty()) {
      $arg = "";
    }
    return "<a".$this->GenerateArgs()." ".$arg.">".$this->Item->Generate()."</a>";
  }
}

?>