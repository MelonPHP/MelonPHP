<?php

require_once("html_core.php");

// Очередь
class HtmlQueue extends HtmlElement
{
  private $ItemsQueue = array();
  
  public function __construct() {
    parent::InitializeHtml();
  }

  public function AddItem(Html $item) : HtmlQueue {
    array_push($this->ItemsQueue, $item);
    return $this;
  }

  public function GetItems() : array {
    return $this->ItemsQueue;
  }

  public function Generate() : string {
    $sQueue = "";
    foreach ($this->ItemsQueue as $value) {
      $sQueue .= $value->Generate();
    }
    return $sQueue;
  }
}

class HtmlMainAxisAligment
{
  const Center = "center";
  const Start = "flex-start";
  const End = "flex-end";
  const Between = "space-between";
  const Around = "space-around";  
}

class HtmlCrossAxisAligment
{
  const Center = "center";
  const Start = "flex-start";
  const End = "flex-end";
  const Baseline = "baseline";
  const Scretch = "stretch";
}

// Контейнер с очередью
abstract class HtmlFlexQueue extends HtmlElement
{
  private $ItemsQueue;
  private $MainAxisAlign = HtmlMainAxisAligment::Start;
  private $CrossAxisAlign = HtmlCrossAxisAligment::Start;

  public function __construct() {
    parent::InitializeHtml();
    $this->ItemsQueue = new HtmlQueue;
  }

  public function AddItem(Html $item) : HtmlFlexQueue {
    $this->ItemsQueue->AddItem($item);
    return $this;
  }

  public function GetItems() {
    return $this->ItemsQueue->GetItems();
  }

  public function SetMainAligment($align) : HtmlFlexQueue {
    $this->MainAxisAlign = $align;
    return $this;
  }

  public function GetMainAligment() {
    return $this->MainAxisAlign;
  }

  public function SetCrossAligment($align) : HtmlFlexQueue {
    $this->CrossAxisAlign = $align;
    return $this;
  }

  public function GetCrossAligment() {
    return $this->CrossAxisAlign;
  }

  public function Generate() : string {
    $argq = $this->GetArgumentsQueue();
    $isStyleFind = false;
    foreach($argq as &$arg) {
      if ($arg->GetName() === "style") {
        $isStyleFind = true;
        $arg->AddItem("justify-content: ".$this->MainAxisAlign.";");
        $arg->AddItem("align-items: ".$this->CrossAxisAlign.";");
        break;
      }
    }
    if (!$isStyleFind) {
      $arg = (new HtmlArgument)->SetName("style");
      $arg->AddItem("justify-content: ".$this->MainAxisAlign.";");
        $arg->AddItem("align-items: ".$this->CrossAxisAlign.";");
      array_push($argq, $arg);
    }
    return (new HtmlTag(
      "div", 
      $argq, 
      $this->ItemsQueue->Generate()
    ))->Generate();
  }

}

// Контейнер с очередью в которой елементы выравниваются по вертикали
class HtmlColumn extends HtmlFlexQueue
{
  public function __construct() {
    parent::__construct();
    $this->AddClassItem("base_column");
  }
}

// Контейнер с очередью в которой елементы выравниваются по горизонтиали
class HtmlRow extends HtmlFlexQueue
{
  public function __construct() {
    parent::__construct();
    $this->AddClassItem("base_row");
  }
}

// Конейнер
class HtmlContainer extends HtmlElement
{
  private $Item;

  public function __construct() {
    parent::InitializeHtml();
    $this->AddClassItem("base_container");
  }

  public function SetItem(Html $item) : HtmlContainer {
    $this->Item = $item;
    return $this;
  }

  public function GetItem() {
    return $this->Item;
  }

  public function Generate() : string {
    return (new HtmlTag(
      "div", 
      $this->GetArgumentsQueue(), 
      $this->Item->Generate()
    ))->Generate();
  }
}

// Конейнер в котором можно выровнять елемент
class HtmlAlignContainer extends HtmlContainer
{
  private $CrossAxisAlign = HtmlCrossAxisAligment::Start;

  public function __construct() {
    parent::__construct();
  }

  public function SetCrossAligment(string $enumber) : HtmlContainer {
    $this->CrossAxisAlign = $enumber;
    return $this;
  }

  public function GetCrossAligment() {
    return $this->CrossAxisAlign;
  }

  public function Generate() : string {
    $argq = $this->GetArgumentsQueue();
    $isStyleFind = false;
    foreach($argq as &$arg) {
      if ($arg->GetName() === "style") {
        $isStyleFind = true;
        $arg->AddItem("align-self: ".$this->CrossAxisAlign.";");
        break;
      }
    }
    if (!$isStyleFind) {
      $arg = (new HtmlArgument)->SetName("style");
      $arg->AddItem("align-self: ".$this->CrossAxisAlign.";");
      array_push($argq, $arg);
    }
    return (new HtmlTag(
      "div", 
      $argq, 
      $this->GetItem()->Generate()
    ))->Generate();
  }
}

class HtmlCenterContainer extends HtmlContainer
{
  public function __construct() {
    parent::__construct();
    $this->AddClassItem("base_container_center");
  }
}

// Конейнер в котором можно прокручивать елементы по вертикали
class HtmlVerticalScrollContainer extends HtmlContainer
{
  public function __construct() {
    parent::__construct();
    $this->AddClassItem("base_scroll_container_v");
  }
}

// Конейнер в котором можно прокручивать елементы по горизонтали
class HtmlHorizontalScrollContainer extends HtmlContainer
{
  public function __construct() {
    parent::__construct();
    $this->AddClassItem("base_scroll_container_h");
  }
}

// Конейнер в котором можно прокручивать елементы по всем осям
class HtmlScrollContainer extends HtmlContainer
{
  public function __construct() {
    parent::__construct();
    $this->AddClassItem("base_scroll_container");
  }
}

?>