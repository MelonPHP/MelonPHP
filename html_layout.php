<?php

require_once("html_core.php");

// Очередь
class HtmlQueue extends HtmlElement
{
  private $ItemsQueue = array();
  
  public function __construct() {
    parent::InitializeHtml();
  }

  public function AddItem(Html $item) {
    array_push($this->ItemsQueue, $item);
    return $this;
  }

  public function GetItems() : array {
    return $this->ItemsQueue;
  }

  public function GetReverseQueue() : HtmlQueue {
    $c = $this;
    $c->ItemsQueue = array_reverse($c->ItemsQueue);
    return $c;
  }

  public function Generate() : string {
    $sQueue = "";
    foreach ($this->ItemsQueue as $value) {
      $sQueue .= $value->Generate();
    }
    return $sQueue;
  }
}


// Контейнер с очередью
abstract class HtmlFlexQueue extends HtmlQueue
{
  private $MainAxisAlign = HtmlMainAxisAligment::Start;
  private $CrossAxisAlign = HtmlCrossAxisAligment::Start;

  public function SetMainAligment($align) {
    $this->MainAxisAlign = $align;
    return $this;
  }

  public function GetMainAligment() {
    return $this->MainAxisAlign;
  }

  public function SetCrossAligment($align) {
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
      parent::Generate()
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

abstract class HtmlColumnArgument extends Html
{
  
}

class HtmlColumnCustomArgument extends HtmlColumnArgument
{
  private $Value;

  public function SetValue(/* string or HtmlColumnArgument */ $value) {
    $this->Value = $value;
    return $this;
  }

  public function GetValue() {
    return $this->Value;
  }

  public function Generate() : string {
    if (is_a($this->Value, "HtmlColumnArgument")) {
      return $this->Value->Generate();
    }
    else {
      return $this->Value;
    }
  }
}

class HtmlColumnMinmaxArgument extends HtmlColumnArgument
{
  private $MinValue;
  private $MaxValue;

  public function SetMinValue(/* string or HtmlColumnArgument */ $value) {
    $this->MinValue = $value;
    return $this;
  }

  public function GetMinValue() {
    return $this->MinValue;
  }

  public function SetMaxValue(/* string or HtmlColumnArgument */ $value) {
    $this->MaxValue = $value;
    return $this;
  }

  public function GetMaxValue() {
    return $this->MaxValue;
  }

  public function Generate() : string {
    $min = $this->MinValue;
    $max = $this->MaxValue;
    if (is_a($min, "HtmlColumnArgument")) {
      $min = $min->Generate();
    }
    if (is_a($max, "HtmlColumnArgument")) {
      $max = $max->Generate();
    }
    return "minmax(".$min.", ".$max.")";
  }
}

class HtmlColumnFitContentArgument extends HtmlColumnCustomArgument
{
  public function Generate() : string {
    $value = parent::Generate();
    return "fit-content(".$value.")";
  }
}

class HtmlColumnRepeatArgument extends HtmlColumnArgument
{
  private $StartValue;
  private $EndValue;

  public function SetStartValue(/* string or HtmlColumnArgument */ $value) {
    $this->StartValue = $value;
    return $this;
  }

  public function GetStartValue() {
    return $this->StartValue;
  }

  public function SetEndValue(/* string or HtmlColumnArgument */ $value) {
    $this->EndValue = $value;
    return $this;
  }

  public function GetEndValue() {
    return $this->EndValue;
  }

  public function Generate() : string {
    $start = $this->StartValue;
    $end = $this->EndValue;
    if (is_a($start, "HtmlColumnArgument")) {
      $start = $start->Generate();
    }
    if (is_a($end, "HtmlColumnArgument")) {
      $end = $end->Generate();
    }
    return "repeat(".$start.", ".$end.")";
  }
}

class HtmlGrid extends HtmlQueue
{
  private $ColumnsArgumentQueue = array();
  private $Gap = "0px";

  public function __construct() {
    parent::__construct();
    $this->AddClassItem("base_grid");
  }

  public function AddGridColumn(HtmlColumnArgument $argument) : HtmlGrid {
    array_push($this->ColumnsArgumentQueue, $argument);
    return $this;
  }

  public function GetGridColumns() : array {
    return $this->ColumnsArgumentQueue;
  }

  public function SetGap(string $string) {
    $this->Gap = $string;
    return $this;
  }

  public function GetGap() : string {
    return $this->Gap;
  }

  private function AddInStyleColumnTeample(&$value) {
    if (count($this->ColumnsArgumentQueue) > 0) {
      $itemsS = "";
      foreach ($this->ColumnsArgumentQueue as $argument) {
        $itemsS .= " ".$argument->Generate();
      }
      $value->AddItem("grid-template-columns:".$itemsS.";");
    }
  }

  private function AddInStyleGap(&$value) {
    $value->AddItem("grid-gap: ".$this->Gap.";");
  }

  public function Generate() : string {
    $argq = $this->GetArgumentsQueue();
    $isFindStyle = false;
    foreach($argq as &$value) {
      if ($value->GetName() == "style") {
        $isFindStyle = true;
        $this->AddInStyleColumnTeample($value);
        $this->AddInStyleGap($value);
      }
    }
    if (!$isFindStyle) {
      $styleArgument = (new HtmlArgument())
      ->SetName("style");
      $this->AddInStyleColumnTeample($styleArgument);
      $this->AddInStyleGap($styleArgument);
      $argq->AddItem($styleArgument);
    }
    return (new HtmlTag(
      "div",
      $argq,
      parent::Generate()
    ))->Generate();
  }
}

// Конейнер
class HtmlContainer extends HtmlElement
{
  private $Item;

  public function __construct() {
    parent::InitializeHtml();
    $this->Item = new HtmlNullable;
    $this->AddClassItem("base_container");
  }

  public function SetItem(Html $item) {
    $this->Item = $item;
    return $this;
  }

  public function GetItem() : Html {
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

  public function SetCrossAligment(string $enumber) {
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