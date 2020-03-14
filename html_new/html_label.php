<?php

require_once("html_core.php");

class HtmlText extends HtmlStaticElement
{
  private $Text;
  
  public function __construct() {
    parent::InitializeHtml();
    $this->AddClassItem("base_text");
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