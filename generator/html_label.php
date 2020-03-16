<?php

require_once("html_core.php");

class HtmlText extends HtmlElement
{
  private $Text;
  
  public function __construct() {
    parent::InitializeHtml();
    $this->AddClassItem("text_base");
  }

  public function SetText(string $string) : HtmlText {
    $this->Text = $string;
    return $this;
  }

  public function GetText() : string {
    return $this->Text;
  }

  public function Generate() : string {
    return (new HtmlTag(
      "p", 
      $this->GetArgumentsQueue(), 
      $this->Text
    ))->Generate();
  }
}

class HtmlTextBreak extends HtmlElement
{
  public function __construct() {
    parent::InitializeHtml();
    $this->AddClassItem("text_base");
  }

  public function Generate() : string {
    return (new HtmlTag(
      "br", 
      $this->GetArgumentsQueue(), 
      null
    ))->Generate();
  }
}

?>