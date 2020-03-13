<?php

require_once("html/html.php");

$title = new HtmlBuilder(function () {
  // example var in builder
  $i = random_int(2, 100);
  // we always shoud return Html class
  return (new HtmlText)
  ->AddStyleItem("font-size: ".strval($i) /* use this var */ ."px;")
  ->AddStyleItem("font-weight: bold;")
  ->SetText("hello");
});

$body = new HtmlBuilder(array($title) /* we can add value in builder like    this */, function ($arg) {
  // there we can run some code
  // we always shoud return Html class
  return (new HtmlContainer)
  ->AddStyleItem("width: 300px;")
  ->AddStyleItem("height: 300px;")
  ->AddStyleItem("background-color: red;")
  ->SetChild($arg[0] /* and we can use this value */);
});

$page = new HtmlBuilder(array($body), function ($arg) {
  return (new HtmlDocument)
  ->SetLanguage("ru")
  ->SetTitle("Пример")
  ->SetBody((new HtmlColumn)
    ->AddItem($arg[0])
    ->AddItem($arg[0])
    ->AddItem($arg[0])
  );
});

// run
HtmlElement::RunOf($page);

?>