<?php

require_once("html/html_core.php");
require_once("html/html_builder.php");
require_once("html/html_table.php");
require_once("html/html_label.php");
require_once("html/html_document.php");
require_once("html/html_layout.php");
require_once("databace/databace_context.php");

class TestHtmlElement extends HtmlElement {
  //  class vars
  private $randId;
  private $pageName = "Пример с запросом к базе данных";

  // constructor
  function __construct() {
    $this->randId = random_int(20, 30);
  }

  // generate title
  function BuildTitle() {
    return (new HtmlText)
    ->SetText("Пример запросса к базе данных")
    ->AddStyleItem("font-size: 28px;");
  }

  // generate space
  function BuildSpace($sheight) {
    return (new HtmlContainer)
    ->SetChild(new HtmlNullable)
    ->AddStyleItem("height: ".$sheight."px;");
  }

  // build subtitle
  function BuildSubtitle() {
    return (new HtmlText)
    ->SetText("В этом примере можно увидеть как работать с запоросами SQL с баззой данных")
    ->AddStyleItem("font-size: 18px;");
  }

  // generate table from request
  function BuildTableFromRequest($title, $result) {
    // create table
    $table = (new HtmlTable)
    ->AddArgument(
      (new HtmlArgument)
      ->SetName("border")
      ->AddItem("2")
    )
    ->AddStyleItem("width: 400px;")
    ->AddLine($title);

    // read request and add new lines in table
    while($result->Read()) {
      $table->AddLine(
        (new HtmlTableLine)
        ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText($result->Get()["Id"])))
        ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText($result->Get()["FirstName"])))
        ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText($result->Get()["LastName"])))
      );
    }

    return $table;
  }

  // send request to db 
  // and genereate user table 
  // and retarn user table 
  // or error
  function GetUsers() {
    // create client
    $client = DatabaceContext::ConnectTo(new ExampleDatabace());

    // connect to collection
    $collection = $client->TestCollection();
    // if connect
    if ($collection->IsConnect()) {
      // send request to db
      $result = $collection->Send("SELECT * FROM exampletable");
    
      // build table from request
      return $this->BuildTableFromRequest(
        (new HtmlTableLine)
        ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Id")))
        ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Имя")))
        ->AddItem((new HtmlTableItem)->SetItem((new HtmlText)->SetText("Фамилия"))),
        $result
      );
    }
    else {
      return (new HtmlText)->SetText("Connect error");
    }
  }

  // generate body
  function BuildBody() {
    return (new HtmlColumn)
    ->AddStyleItem("margin: 27px 37px")
    ->AddItem($this->BuildTitle())
    ->AddItem($this->BuildSpace(0))
    ->AddItem($this->BuildSubtitle())
    ->AddItem($this->BuildSpace(15))
    ->AddItem($this->GetUsers());
  }

  // main and build
  // shoud return Html class
  function Build() {
    return (new HtmlDocument)
    ->AddStyleItem("margin: 0px;")
    ->SetTitle($this->pageName)
    ->SetLanguage("ru")
    ->SetBody($this->BuildBody());
  }
}

// run
(new TestHtmlElement)->Run();

?>