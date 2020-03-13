<?php

require_once("html/html.php");
require_once("html_request_generator_element.php");
require_once("databace/databace_context.php");

// TAGS: R, exampletable
$request1 = new HtmlBuilder(function () {
  $client = DatabaceContext::ConnectTo(new ExampleDatabace());

  $collection = $client->TestCollection();

  if ($collection->IsConnect()) {
    $result = $collection->Send("SELECT * FROM exampletable");

    return (new HtmlTableRequestGeneratorElement)
    ->SetTitle("Тестовый к базе данных")
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

// TAGS: R1, goods
$request2 = new HtmlBuilder(function () {
  $client = DatabaceContext::ConnectTo(new ExampleDatabace());

  $collection = $client->ExampleCollection();

  if ($collection->IsConnect()) {
    $result = $collection->Send("SELECT * FROM goods");

    return (new HtmlTableRequestGeneratorElement)
    ->SetTitle("Запрос к базе данных #1")
    ->SetSubtitle("Берем все данные из таблицы goods и выводим их")
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

// TAGS: R2, goods
$request3 = new HtmlBuilder(function () {
  $client = DatabaceContext::ConnectTo(new ExampleDatabace());

  $collection = $client->ExampleCollection();

  if ($collection->IsConnect()) {
    $result = $collection->Send("SELECT IdGood, GoodPrice FROM goods");

    return (new HtmlTableRequestGeneratorElement)
    ->SetTitle("Запрос к базе данных #2")
    ->SetSubtitle("Берем номер заказа и цену из таблицы goods и выводим их")
    ->SetRequestResult($result)
    ->SetTitleLine(
      (new HtmlTableLine)
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Good Id")))
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Price")))
    );
  }
});

// TAGS: R3, goods
$request4 = new HtmlBuilder(function () {
  $client = DatabaceContext::ConnectTo(new ExampleDatabace());

  $collection = $client->ExampleCollection();

  if ($collection->IsConnect()) {
    $result = $collection->Send("SELECT IdGood, GoodDate, GoodPrice FROM goods WHERE GoodDate <= '2020-3-11'");

    return (new HtmlTableRequestGeneratorElement)
    ->SetTitle("Запрос к базе данных #3")
    ->SetSubtitle("Берем номер заказа и цену, и дату заказа из таблицы goods и выводим только то, где заказ заказан раньше '2020-3-12'")
    ->SetRequestResult($result)
    ->SetTitleLine(
      (new HtmlTableLine)
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Good Id")))
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Date")))
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Price")))
    );
  }
});

// TAGS: R4, goods
$request5 = new HtmlBuilder(function () {
  $client = DatabaceContext::ConnectTo(new ExampleDatabace());

  $collection = $client->ExampleCollection();

  if ($collection->IsConnect()) {
    $result = $collection->Send("SELECT IdGood, GoodDate, GoodPrice FROM goods WHERE GoodDate <= '2020-3-11'");

    return (new HtmlTableRequestGeneratorElement)
    ->SetTitle("Запрос к базе данных #4")
    ->SetSubtitle("Берем номер заказа и цену, и дату заказа из таблицы goods и выводим только то, где заказ заказан раньше '2020-3-12'")
    ->SetRequestResult($result)
    ->SetTitleLine(
      (new HtmlTableLine)
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Good Id")))
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Date")))
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Price")))
    );
  }
});

// TAGS: R5, customers
$request6 = new HtmlBuilder(function () {
  $client = DatabaceContext::ConnectTo(new ExampleDatabace());

  $collection = $client->ExampleCollection();

  if ($collection->IsConnect()) {
    $result = $collection->Send("SELECT * FROM customers");

    return (new HtmlTableRequestGeneratorElement)
    ->SetTitle("Запрос к базе данных #5")
    ->SetSubtitle("Берем данные из таблицы customers и выводим их")
    ->SetRequestResult($result)
    ->SetTitleLine(
      (new HtmlTableLine)
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Id")))
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Name")))
      ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Adress")))
    );
  }
});

$page = new HtmlBuilder(array($request1, $request2, $request3, $request4, $request5, $request6), function ($args) {
  return (new HtmlDocument)
  ->SetLanguage("ru")
  ->SetTitle("Задание 9")
  ->SetBody(
    (new HtmlCenter)
    ->AddStyleItem("width: 600px;")
    ->SetItem(
      (new HtmlColumn)
      ->AddItem($args[0])
      ->AddItem($args[1])
      ->AddItem($args[2])
      ->AddItem($args[3])
      ->AddItem($args[4])
      ->AddItem($args[5])
    )
  );
});

HtmlElement::RunOf($page);

?>