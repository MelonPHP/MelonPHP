<?php

require "generator/html.php";

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

class ListCard extends HtmlComponent
{
  private $Title;
  private $Subtitle;

  public function __construct($title, $subtitle) {
    $this->Title = $title;
    $this->Subtitle = $subtitle;
  }
  
  function Build() : Html {
    return (new HtmlContainer)
    ->AddStyleItem("width", "100%")
    ->AddStyleItem("padding", "25px")
    ->AddStyleItem("margin", "15px")
    ->AddStyleItem("background-color", "white")
    ->AddStyleItem("border-radius", "6px")
    ->AddStyleItem("box-shadow", "0 0 5px rgba(0,0,0,0.1)")
    ->SetItem(
      (new HtmlColumn)
      ->AddItem(
        (new HtmlText)
        ->AddStyleItem("font-size", "16px")
        ->AddStyleItem("font-weight", "500")
        ->AddStyleItem("margin", "0 0 15px 0")
        ->SetText($this->Title)
      )
      ->AddItem(
        (new HtmlText)
        ->SetText($this->Subtitle)
      )
    );
  }
}

$titleBar = new HtmlBuilder(function () {
  return (new HtmlContainer)
  ->AddStyleItem("width", "100%")
  ->AddStyleItem("z-index", "1")
  ->AddStyleItem("background-color", "white")
  ->AddStyleItem("box-shadow", "0 0 4px rgba(0,0,0,0.25)")
  ->SetItem(
    (new HtmlCenterContainer)
    ->AddStyleItem("width", "100%")
    ->AddStyleItem("height", "100%")
    ->SetItem(
      (new HtmlRow)
      ->AddStyleItem("min-width", "600px")
      ->AddItem(new TitleBarButton("Главная"))
      ->AddItem(new TitleBarButton("Документация"))
      ->AddItem(new TitleBarButton("Другое"))
    )
  );
});

$cardList = new HtmlBuilder(function () {
  $list = new HtmlColumn;
  for ($i=0; $i < 30; $i++) { 
    ($list)->AddItem(new ListCard("Сообщение $i", "Код подтверждения: 98961. Никому не давайте код, даже если его требуют от имени Telegram! Этот код используется для входа в Ваш аккаунт в Telegram. Он никогда не нужен для чего-то еще.  Если Вы не запрашивали код для входа, проигнорируйте это сообщение."));
  }
  return (new HtmlVerticalScrollContainer)
  ->AddStyleItem("width", "100%")
  ->AddStyleItem("height", "100%")
  ->SetItem(
    (new HtmlCenterContainer)
    ->AddStyleItem("max-width", "600px")
    ->SetItem($list)
  );
});

$page = new HtmlBuilder(array($titleBar, $cardList), function ($args) {
  return (new HtmlDocument)
  ->AddStyleItem("background-color", "#f7f7f7")
  ->AddHeader(
    (new HtmlDocumentLink)
    ->SetTypeItem("text/css")
    ->SetRelItem("stylesheet")
    ->SetHrefItem("custom.css")
  )
  ->SetTitle("Test page")
  ->SetBody(
    (new HtmlColumn)
    ->AddStyleItem("width", "100%")
    ->AddStyleItem("height", "100%")
    ->AddStyleItem("position", "fixed")
    ->AddItem($args[0])
    ->AddItem($args[1])
  );
});

// its like main
Html::RunOf($page, true /* debug is on */);

?>