<?php

require_once("https://ingective.github.io/HTMLToPHP/html_core.php");

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
    return (new HtmlTag("p", $this->GetArgumentsQueue(), $this->Text))->Generate();
  }
}

?>