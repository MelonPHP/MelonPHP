<?php

require_once("generator/html.php");

class Container extends HtmlComponent
{
  private $Width;
  private $Height;

  function __construct($width, $height) {
    $this->Width = $width;
    $this->Height = $height;
  }

  function GetContainer() {
    return (new HtmlLink)
    ->SetLink("#")
    ->SetItem(
      (new HtmlContainer)
      ->SetItem(
        (new HtmlText)
        ->SetText("T_T")
      )
    );
  }

  function Build() {
    return $this->GetContainer()
    ->AddStyleItem("margin", "1px")
    ->AddStyleItem("width", $this->Width."px")
    ->AddStyleItem("height", $this->Height."px");
  }
}

class Red extends Container
{
  function Build() {
    return parent::Build()
    ->AddClassItem("red");
  }
}

class Blue extends Container
{
  function Build() {
    return parent::Build()
    ->AddClassItem("blue");
  }
}

class Green extends Container
{
  function Build() {
    return parent::Build()
    ->AddClassItem("green");
  }
}

$layout1 = new HtmlBuilder(function () {
  return (new HtmlColumn)
  ->AddItem(
    (new HtmlRow)
    ->AddItem(new Blue(50, 50))
    ->AddItem(new Red(100, 50))
  )
  ->AddItem(
    (new HtmlRow)
    ->AddItem(new Red(100, 50))
    ->AddItem(new Green(50, 50))
  )
  ->AddItem(
    (new HtmlRow)
    ->AddItem(new Red(75, 50))
    ->AddItem(new Blue(75, 50))
  );
});

$page = new HtmlBuilder(array($layout1), function ($args) {
  return (new HtmlDocument)
  ->SetTitle("layout test")
  ->SetLanguage("ru")
  ->AddHeader(
    (new HtmlDocumentLink)
    ->SetTypeItem("text/css")
    ->SetRelItem("stylesheet")
    ->SetHrefItem("layout_test.css")
  )
  ->SetBody(
    (new HtmlScrollContainer)
    ->SetItem(
      (new HtmlCenterContainer)
      ->SetItem(
        (new HtmlColumn)
        ->AddItem(
          (new HtmlRow)
          ->AddItem($args[0])
          ->AddItem($args[0])
        )
        ->AddItem(
          (new HtmlRow)
          ->AddItem($args[0])
          ->AddItem($args[0])
        )
      )
    )
  );
});

Html::RunOf($page, true);

?>