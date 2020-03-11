<?php

require_once("html/html_core.php");

class HtmlDocument extends HtmlComponent
{
    private $Body;
    private $Lang = "en";
    private $Title = "";

    public function SetTitle($string) {
        $this->Title = $string;
        return $this;
    }

    public function SetLanguage($string) {
        $this->Lang = $string;
        return $this;
    }

    public function SetBody($string) {
        $this->Body = $string;
        return $this;
    }

    public function Generate() {
        return "<!DOCTYPE html><html lang=\"".$this->Lang."\"><head><title>".$this->Title."</title></head><body".$this->GenerateArgs().">".$this->Body->Generate()."</body></html>";
    }
}
?>