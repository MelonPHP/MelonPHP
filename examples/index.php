<?php

require "https://ingective.github.io/HTMLToPHP/html.php";

class TitleBarButton extends HtmlComponent
{
  private $Text;

  public function __construct($text) {
    $this->Text = $text;
  }
  
  function Build() : Html {
    return (new HtmlContainer)
    ->AddStyleItem("width", "100%")
    ->AddStyleItem("padding", "7px 13px")
    ->AddStyleItem("margin", "5px 0")
    ->AddClassItem("nav_button")
    ->SetItem(
      (new HtmlCenterContainer)
      ->SetItem(
        (new HtmlText)
        ->SetText($this->Text)
      )
    );
  }
}

$titleBar = new HtmlBuilder(function () {
  return (new HtmlContainer)
  ->AddStyleItem("width", "100%")
  ->AddStyleItem("background-color", "white")
  ->AddStyleItem("box-shadow", "0 0 4px rgba(0,0,0,0.25)")
  ->SetItem(
    (new HtmlCenterContainer)
    ->SetItem(
      (new HtmlRow)
      ->AddStyleItem("min-width", "600px")
      ->AddItem(new TitleBarButton("Главная"))
      ->AddItem(new TitleBarButton("Документация"))
      ->AddItem(new TitleBarButton("Другое"))
    )
  );
});

$page = new HtmlBuilder(array($titleBar), function ($args) {
  return (new HtmlDocument)
  ->AddStyleItem("background-color", "#f7f7f7")
  ->AddHeader(
    (new HtmlDocumentLink)
    ->SetTypeItem("text/css")
    ->SetRelItem("stylesheet")
    ->SetHrefItem("custom.css")
  )
  ->SetTitle("Test page")
  ->SetBody($args[0]);
});

// its like main
Html::RunOf($page, true /* debug is on */);

?>