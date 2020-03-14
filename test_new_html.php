<?php

require_once("html_new/html.php");

$text = new HtmlBuilder(function () {
  return (new HtmlText)
  ->AddClassItem("my_text_css")
  ->AddStyleItem("color", "grey")
  ->AddStyleItem("font-weight", "bold")
  ->AddArgument(  
    (new HtmlArgument)
    ->SetName("name")
    ->AddItem("hello")
  )
  ->SetText("Test text");
});

$page = new HtmlBuilder(array($text), function($args) {
  return (new HtmlDocument)
  ->SetBody($args[0]);
});

Html::RunOf($page, true);

?>