<?php

use function PHPSTORM_META\type;

abstract class Html
{
  abstract public function Generate() : string;

  public static function RunOf(Html $item, bool $debug) {
    echo $debug ? $item->Generate() : @$item->Generate();
  }
}

abstract class HtmlBase extends Html
{
  protected $Context;

  protected function InitializeHtml() {
    $this->Context = new HtmlContext;
  }
}

abstract class HtmlElement extends HtmlBase
{
  private $ArgumentsQueue = array();

  private $StyleArgument;
  private $ClassArgument;
  private $IdArgument;

  protected function InitializeHtml() {
    parent::InitializeHtml();
    $this->StyleArgument = (new HtmlArgument)->SetName("style");
    $this->ClassArgument = (new HtmlArgument)->SetName("class");
    $this->IdArgument = (new HtmlArgument)->SetName("id");
  }

  public function AddClassItem(string $string) {
    $this->ClassArgument->AddItem($string);
    return $this;
  }

  public function AddStyleItem(string $stringName, string $stringData) {
    $this->StyleArgument->AddItem($stringName.": ".$stringData.";");
    return $this;
  }

  public function AddArgument(HtmlArgument $item) {
    array_push($this->ArgumentsQueue, $item);
    return $this;
  }

  public function &GetClassArgumentLink() : HtmlArgument {
    return $this->ClassArgument;
  }

  public function &GetStyleArgumentLink() : HtmlArgument {
    return $this->StyleArgument;
  }

  protected function GetArgumentsQueue() : array {
    $argq = array();
    $idArg = $this->IdArgument;
    $idArg->AddItem($this->Context->GetId());
    array_push($argq, $idArg);
    array_push($argq, $this->ClassArgument);
    array_push($argq, $this->StyleArgument);
    foreach ($this->ArgumentsQueue as $item) {
      array_push($argq, $item);
    }
    return $argq;
  }

  public function GetId() : string {
    return $this->Context->GetId();
  }

  public function &GetContext() : HtmlContext {
    return $this->Context;
  }
}

class HtmlBuilder extends Html
{
  private $Function;
  private $Arguments;

  public function __construct() {
    $numargs = func_num_args();
    $args = func_get_args();

    if ($numargs == 2) {
      $this->Arguments = $args[0];
      $this->Function = $args[1];
    }
    else if ($numargs == 1) {
      $this->Function = $args[0];
    }
    else
      throw new Exception("bad HtmlBuilder construct");
  }

  public function Build() : Html {
    if ($this->Arguments != null)
      return call_user_func($this->Function, $this->Arguments);
    else
      return call_user_func($this->Function, array());
  }

  public function Generate() : string {
    return $this->Build()->Generate();
  }
}

abstract class HtmlComponent extends HtmlBase
{
  abstract function Build() /* html */;

  public function Generate() : string {
    return $this->Build()->Generate();
  }
}

class HtmlTag extends Html
{
  private $Name;
  private $Content;
  private $ArgumentsQueue;

  public function __construct(string $name, array $argq, $content) {
    $this->Name = $name;
    $this->Content = $content;
    $this->ArgumentsQueue = $argq;
  }

  public function GenerateArgumentsQueue() : string {
    $args = $this->ArgumentsQueue;
    $sQueue = "";
    foreach ($args as &$item) {
      if (!$item->IsEmpty())
        $sQueue .= " ".$item->Generate();
    }
    return $sQueue;
  }

  public function Generate() : string {
    if ($this->Content != null)
      return "<".$this->Name.$this->GenerateArgumentsQueue().">".$this->Content."</".$this->Name.">";
    else
      return "<".$this->Name.$this->GenerateArgumentsQueue()."/>";
  }
}

class HtmlArgument extends Html
{
  private $Name;
  private $ItemsQueue = array();

  public function SetName(string $string) {
    $this->Name = $string;
    return $this;
  }

  public function GetName() : string {
    return $this->Name;
  }

  public function AddItem(string $string) {
    array_push($this->ItemsQueue, $string);
    return $this;
  }

  public function GetItems() : array {
    return $this->ItemsQueue;
  }

  public function ReverseItems() {
    $this->ItemsQueue = array_reverse($this->ItemsQueue);
  }

  public function RemoveItemByIndex(int $index) {
    array_splice($this->ItemsQueue, $index, 1, array());
  }

  public function RemoveAllItems() {
    $this->ItemsQueue = array();
  }

  public function IsEmpty() : bool {
    return $this->Name == null 
    || count($this->ItemsQueue) < 1;
  }

  public function Generate() : string {
    $itemsQueueString = "";
    $itemsCount = count($this->ItemsQueue);
    for ($i=0; $i < $itemsCount; $i++) {
      $item = $this->ItemsQueue[$i];
      $itemsQueueString .= $item.($i != $itemsCount - 1 ? " " : "");
    }
    return $this->Name."='$itemsQueueString'";
  }
}

class HtmlContext
{
  private $Id;
  private $Items = array();

  public function __construct() {
    $this->Id = sha1(random_bytes(64));
  }

  public function AddItem(string $key, $other) {
    $this->Items[$key] = $other;
    return $this;
  }

  public function RemoveItem(string $key) {
    $this->Items[$key] = null;
  }
  
  public function GetItem(string $key) {
    return $this->Items[$key];
  }

  public function GetId() : string {
    return $this->Id;
  }

  public function SetId(string $id) {
    $this->Id = $id;
  }
}

class HtmlNullable extends HtmlElement
{
  public function __construct() {
    $this->InitializeHtml();
  }

  public function Generate() : string {
    return " ";
  }
}

?>