<?php

require_once("https://ingective.github.io/HTMLToPHP/html_core.php");

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
    $this->AddClassItem("base_column");
  }

  public function Generate() : string {
    return (new HtmlTag(
      "div", 
      $this->GetArgumentsQueue(), 
      parent::Generate()
    ))->Generate();
  }
}

class HtmlRow extends HtmlQueue
{
  public function __construct() {
    parent::__construct();
    parent::InitializeHtml();
    $this->AddClassItem("base_row");
  }

  public function Generate() : string {
    return (new HtmlTag(
      "div", 
      $this->GetArgumentsQueue(), 
      parent::Generate()
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