<?php

require_once("html_core.php");
require_once("html_layout.php");

class HtmlDocument extends HtmlStaticElement
{
  private $Title = "HTMLToPHP Framework";
  private $Language = "en";
  private $Charset = "UFT-8";
  private $Body;
  private $HeaderQueue = array();

  public function __construct() {
    parent::InitializeHtml();
  }

  public function SetLanguage(string $string) : HtmlDocument {
    $this->Language = $string;
    return $this;
  }

  public function SetTitle(string $string) : HtmlDocument {
    $this->Title = $string;
    return $this;
  }

  public function SetCharset(string $string) : HtmlDocument {
    $this->Title = $string;
    return $this;
  }

  public function SetBody(Html $item) : HtmlDocument {
    $this->Body = $item;
    return $this;
  }

  public function AddHeader(HtmlDocumentHeader $item) : HtmlDocument {
    $this->Body = $item;
    return $this;
  }

  public function GenerateHeaderQueue() : HtmlQueue {
    $argq = $this->HeaderQueue;
    array_push($argq, (new HtmlDocumentLink)
      ->SetRelItem("stylesheet")
      ->SetTypeItem("text/css")
      ->SetHrefItem("https://injection-php-generator.000webhostapp.com/base.css")
    );
    array_push($argq, (new HtmlDocumentMeta)->AddArgument(
      (new HtmlArgument)
      ->SetName("charset")
      ->AddItem($this->Charset)
    ));
    array_push($argq, new HtmlTag("title", array(), $this->Title));
    $queue = new HtmlQueue;
    foreach ($argq as $item) {
      $queue->AddItem($item);
    }
    return $queue;
  }

  public function Generate() : string {
    return "<!DOCTYPE html>".(new HtmlTag(
      "html", 
      array(
        (new HtmlArgument)
        ->SetName("lang")
        ->AddItem($this->Language)
      ),
      (new HtmlQueue)
      ->AddItem(
        new HtmlTag(
          "header",
          array(),
          $this->GenerateHeaderQueue()->Generate()
        )
      )
      ->AddItem(
        new HtmlTag(
          "body",
          $this->GetArgumentsQueue(),
          $this->Body->Generate()
        )
      )->Generate()
    ))->Generate();
  }
}

abstract class HtmlDocumentHeader extends HtmlStaticElement
{
  public function IsEmpty() : bool {
    return false;
  }
}

class HtmlDocumentMeta extends HtmlDocumentHeader
{
  private $PropertyArgument;
  private $NameArgument;
  private $TypeArgument;
  private $ContentArgument;
  
  public function __construct() {
    parent::InitializeHtml();
    $this->PropertyArgument = (new HtmlArgument)
    ->SetName("property");
    $this->NameArgument = (new HtmlArgument)
    ->SetName("name");
    $this->TypeArgument = (new HtmlArgument)
    ->SetName("type");
    $this->ContentArgument = (new HtmlArgument)
    ->SetName("content");
  }

  public function SetPropertyItem(string $string) : HtmlDocumentMeta {
    $this->PropertyArgument->RemoveAllItems();
    $this->PropertyArgument->AddItem($string);
    return $this;
  }

  public function SetTypeItem(string $string) : HtmlDocumentMeta {
    $this->TypeArgument->RemoveAllItems();
    $this->TypeArgument->AddItem($string);
    return $this;
  }

  public function SetContentItem(string $string) : HtmlDocumentMeta {
    $this->ContentArgument->RemoveAllItems();
    $this->ContentArgument->AddItem($string);
    return $this;
  }

  public function SetNameItem(string $string) : HtmlDocumentMeta {
    $this->NameArgument->RemoveAllItems();
    $this->NameArgument->AddItem($string);
    return $this;
  }

  public function &GetPropertyArgumentLink() : HtmlArgument {
    return $this->PropertyArgument;
  }

  public function &GetNameArgumentLink() : HtmlArgument {
    return $this->NameArgument;
  }

  public function &GetTypeArgumentLink() : HtmlArgument {
    return $this->TypeArgument;
  }

  public function &GetContentArgumentLink() : HtmlArgument {
    return $this->ContentArgument;
  }

  public function Generate() : string {
    $argq = $this->GetArgumentsQueue();
    array_push($argq, $this->NameArgument);
    array_push($argq, $this->TypeArgument);
    array_push($argq, $this->PropertyArgument);
    array_push($argq, $this->ContentArgument);
    $argq = array_splice($argq, 3, count($argq) - 1, array());
    return (new HtmlTag("meta", $argq, null))->Generate();
  }
}

class HtmlDocumentLink extends HtmlDocumentHeader
{
  private $RelArgument;
  private $HrefArgument;
  private $TypeArgument;
  private $SizesArgument;
  
  public function __construct() {
    parent::InitializeHtml();
    $this->RelArgument = (new HtmlArgument)
    ->SetName("rel");
    $this->HrefArgument = (new HtmlArgument)
    ->SetName("href");
    $this->TypeArgument = (new HtmlArgument)
    ->SetName("type");
    $this->SizesArgument = (new HtmlArgument)
    ->SetName("sizes");
  }

  public function SetRelItem(string $string) : HtmlDocumentLink {
    $this->RelArgument->RemoveAllItems();
    $this->RelArgument->AddItem($string);
    return $this;
  }

  public function SetTypeItem(string $string) : HtmlDocumentLink {
    $this->TypeArgument->RemoveAllItems();
    $this->TypeArgument->AddItem($string);
    return $this;
  }

  public function SetHrefItem(string $string) : HtmlDocumentLink {
    $this->HrefArgument->RemoveAllItems();
    $this->HrefArgument->AddItem($string);
    return $this;
  }

  public function SetSizesItem(string $string) : HtmlDocumentLink {
    $this->SizesArgument->RemoveAllItems();
    $this->SizesArgument->AddItem($string);
    return $this;
  }

  public function &GetRelArgumentLink() : HtmlArgument {
    return $this->RelArgument;
  }

  public function &GetHrefArgumentLink() : HtmlArgument {
    return $this->HrefArgument;
  }

  public function &GetTypeArgumentLink() : HtmlArgument {
    return $this->TypeArgument;
  }

  public function &GetSizesArgumentLink() : HtmlArgument {
    return $this->SizesArgument;
  }

  public function Generate() : string {
    $argq = $this->GetArgumentsQueue();
    array_push($argq, $this->RelArgument);
    array_push($argq, $this->SizesArgument);
    array_push($argq, $this->TypeArgument);
    array_push($argq, $this->HrefArgument);
    $argq = array_splice($argq, 3, count($argq) - 1, array());
    return (new HtmlTag("link", $argq, null))->Generate();
  }
}

class HtmlDocumentScript extends HtmlDocumentHeader
{
  private $SrcArgument;
  private $Content;
  
  public function __construct() {
    parent::InitializeHtml();
    $this->SrcArgument = (new HtmlArgument)
    ->SetName("src");
  }

  public function SetSrcItem(string $string) : HtmlDocumentScript {
    $this->SrcArgument->RemoveAllItems();
    $this->SrcArgument->AddItem($string);
    return $this;
  }

  public function SetContent($other) : HtmlDocumentScript {
    $this->Content = $other;
    return $this;
  }

  public function &GetSizesArgumentLink() : HtmlArgument {
    return $this->SrcArgument;
  }

  public function Generate() : string {
    $argq = $this->GetArgumentsQueue();
    array_push($argq, $this->SrcArgument);
    $argq = array_splice($argq, 3, count($argq) - 1, array());
    return (new HtmlTag("script", $argq, $this->Content))->Generate();
  }
}

?>