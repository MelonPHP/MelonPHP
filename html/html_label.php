<?php

require_once("html/html_core.php");

class HtmlText extends HtmlComponent
{
    private $Text;

    public function SetText($string) {
        $this->Text = $string;
        return $this;
    }

    public function Generate() {
        return "<p".$this->GenerateArgs().">".$this->Text."</p>";
    }
}
?>