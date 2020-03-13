<?php

require_once("html/html.php");

$column = new HtmlBuilder(function() {
  $column = new HtmlColumn;
  $randB = random_int(0, 1);
  for ($i=0; $i < 10; $i++) { 
    $item = (new HtmlText)->SetText("Item #".($i + 1));

    if ($i % 2 === $randB) {
      $column->AddItem(
        (new HtmlLink)
        ->SetLink("df")
        ->SetItem($item)
      );
    }
    else
      $column->AddItem($item);
  }
  return $column;
});

$page = new HtmlBuilder(array("column" => $column), function($arg) {
  return (new HtmlDocument)
  ->SetTitle("Test")
  ->SetBody($arg["column"]);
});

HtmlElement::RunOf($page);

?>