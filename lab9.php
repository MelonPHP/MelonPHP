<?php

require_once("html/html.php");
require_once("html_request_generator_element.php");
require_once("databace/databace_context.php");

$request1 = new HtmlBuilder(function () {
  $client = DatabaceContext::ConnectTo(new ExampleDatabace());

  $collection = $client->TestCollection();

  if ($collection->IsConnect()) {
    $result = $collection->Send("SELECT * FROM exampletable");

    return (new HtmlTableRequestGeneratorElement)
    ->SetTitle("Запрос к базе данных 1")
    ->SetSubtitle("Спешл для яценко")
    ->SetRequestResult($result)
    ->SetTitleLine(
      (new HtmlTableLine)
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Id")))
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Имя")))
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Фамилия")))
    );
  }  
});

$request2 = new HtmlBuilder(function () {
  $client = DatabaceContext::ConnectTo(new ExampleDatabace());

  $collection = $client->ExampleCollection();

  if ($collection->IsConnect()) {
    $result = $collection->Send("SELECT * FROM goods");

    return (new HtmlTableRequestGeneratorElement)
    ->SetTitle("Запрос к базе данных 2")
    ->SetSubtitle("Спешл для яценко")
    ->SetRequestResult($result)
    ->SetTitleLine(
      (new HtmlTableLine)
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Good Id")))
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Customer Id")))
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Date")))
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Price")))
    );
  }
});

$page = new HtmlBuilder(array($request1, $request2), function ($args) {
  return (new HtmlDocument)
  ->SetLanguage("ru")
  ->SetTitle("Задание 9")
  ->SetBody(
    (new HtmlColumn)
    ->AddItem($args[0])
    ->AddItem($args[1])
  );
});

HtmlElement::RunOf($page);

?>