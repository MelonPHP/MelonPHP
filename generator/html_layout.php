<?php

require_once("html_core.php");

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

class HtmlColumn extends HtmlQueue
{
  public function __construct() {
    parent::__construct();
    $this->AddClassItem("base_table_column");
  }

  private function GenerateQueue() : string {
    $sQueue = "";
    foreach ($this->GetItems() as $value) {
<<<<<<< HEAD:generator/html_layout.php
      if (is_a($value, "HtmlComponent") || is_a($value, "HtmlBuilder")) {
=======
      if (is_a($value, "HtmlComponent")) {
>>>>>>> d8fe7610dcb42bf1869a47acf2101b306aae25df:html_layout.php
        $value = $value->Build();
      }
        $value->AddClassItem("base_table_item");
      $sQueue .= $value->Generate();
    }
    return $sQueue;
  }

  public function Generate() : string {
    return (new HtmlTag(
      "div", 
      $this->GetArgumentsQueue(), 
      $this->GenerateQueue()
    ))->Generate();
  }
}

class HtmlRow extends HtmlQueue
{
  public function __construct() {
    parent::__construct();
    $this->AddClassItem("base_table_row");
  }

  private function GenerateQueue() : string {
    $sQueue = "";
    foreach ($this->GetItems() as $value) {
<<<<<<< HEAD:generator/html_layout.php
      if (is_a($value, "HtmlComponent") || is_a($value, "HtmlBuilder")) {
=======
      if (is_a($value, "HtmlComponent")) {
>>>>>>> d8fe7610dcb42bf1869a47acf2101b306aae25df:html_layout.php
        $value = $value->Build();
      }
        $value->AddClassItem("base_table_item");
      $sQueue .= $value->Generate();
    }
    return $sQueue;
  }

  public function Generate() : string {
    return (new HtmlTag(
      "div", 
      $this->GetArgumentsQueue(), 
      $this->GenerateQueue()
    ))->Generate();
  }
}

class HtmlContainer extends HtmlElement
{
  private $Item;

  public function __construct() {
    parent::InitializeHtml();
  }

  public function SetItem(Html $item) : HtmlContainer {
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

class HtmlVerticalScrollContainer extends HtmlContainer
{
  public function __construct() {
    parent::__construct();
    $this->AddClassItem("base_v_scroll_container");
  }
}

class HtmlHorizontalScrollContainer extends HtmlContainer
{
  public function __construct() {
    parent::__construct();
    $this->AddClassItem("base_h_scroll_container");
  }
}

class HtmlPositionContainer extends HtmlContainer
{
  // TODO: SET GET
  private $left = 0.0;
  private $top = 0.0;

  public function __construct() {
    parent::__construct();
    $this->AddClassItem("base_position_container");
  }
}

class HtmlCenterContainer extends HtmlContainer
{
  public function __construct() {
    parent::__construct();
    $this->AddClassItem("base_center_container");
  }
}

?>