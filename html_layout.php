<?php

require_once("html_core.php");

class HtmlQueue extends HtmlStaticElement
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

?>