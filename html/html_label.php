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
        $this
        ->AddStyleItem("padding: 0px") 
        ->AddStyleItem("margin: 0px")
        ->AddStyleItem("text-align: left")
        ->AddStyleItem("font-family: 'Segoe UI', Frutiger, 'Frutiger Linotype', 'Dejavu Sans', 'Helvetica Neue', Arial, sans-serif");

        return "<p".$this->GenerateArgs().">".$this->Text."</p>";
    }
}
?>