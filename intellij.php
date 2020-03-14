<?php

abstract class Html
{
  abstract public function Generate() : string;

  abstract public static function RunOf(Html $item, bool $debug);
}

abstract class HtmlBase extends Html
{
  protected $Context;

  abstract protected function InitializeHtml();
}

abstract class HtmlStaticElement extends HtmlBase
{
  abstract protected function InitializeHtml();

  abstract public function AddClassItem(string $string) : HtmlStaticElement;

  abstract public function AddStyleItem(string $stringName, string $stringData) : HtmlStaticElement;

  abstract public function AddArgument(HtmlArgument $item) : HtmlStaticElement;

  abstract public function &GetClassArgumentLink() : HtmlArgument;

  abstract public function &GetStyleArgumentLink() : HtmlArgument;

  abstract protected function GetArgumentsQueue() : array;

  abstract public function GetId() : string;
}

abstract class HtmlBuilder extends Html
{
  abstract public function __construct();

  abstract public function Generate() : string;
}

abstract class HtmlComponent extends HtmlBase
{
  abstract function Build() : Html;

  abstract function Generate() : string;
}

abstract class HtmlTag extends Html
{
  abstract public function __construct(string $name, array $argq, $content);

  abstract public function GenerateArgumentsQueue() : string;

  abstract public function Generate() : string;
}

abstract class HtmlArgument extends Html
{
  abstract public function SetName(string $string) : HtmlArgument;

  abstract public function GetName() : string;

  abstract public function AddItem(string $string) : HtmlArgument;

  abstract public function GetItems() : array;

  abstract public function RemoveItemByIndex(int $index);

  abstract public function RemoveAllItems();

  abstract public function IsEmpty() : bool;

  abstract public function Generate() : string;
}

abstract class HtmlContext
{
  abstract public function __construct();

  abstract public function AddItem(string $key, $other) : HtmlContext;

  abstract public function RemoveItem(string $key);
  
  abstract public function GetItem(string $key);

  abstract public function GetId() : string;
}

abstract class HtmlDocument extends HtmlStaticElement
{
  abstract public function __construct();

  abstract public function SetLanguage(string $string) : HtmlDocument;

  abstract public function SetTitle(string $string) : HtmlDocument;

  abstract public function SetCharset(string $string) : HtmlDocument;

  abstract public function SetBody(Html $item) : HtmlDocument;

  abstract public function AddHeader(HtmlDocumentHeader $item) : HtmlDocument;

  abstract public function GenerateHeaderQueue() : HtmlQueue;

  abstract public function Generate() : string;
}

abstract class HtmlDocumentHeader extends HtmlStaticElement
{
  abstract public function IsEmpty() : bool;
}

abstract class HtmlDocumentMeta extends HtmlDocumentHeader
{
  abstract public function __construct();

  abstract public function SetPropertyItem(string $string) : HtmlDocumentMeta;

  abstract public function SetTypeItem(string $string) : HtmlDocumentMeta;

  abstract public function SetContentItem(string $string) : HtmlDocumentMeta;

  abstract public function SetNameItem(string $string) : HtmlDocumentMeta;

  abstract public function &GetPropertyArgumentLink() : HtmlArgument;

  abstract public function &GetNameArgumentLink() : HtmlArgument;

  abstract public function &GetTypeArgumentLink() : HtmlArgument;

  abstract public function &GetContentArgumentLink() : HtmlArgument;

  abstract public function Generate() : string;
}

abstract class HtmlDocumentLink extends HtmlDocumentHeader
{
  abstract public function __construct();

  abstract public function SetRelItem(string $string) : HtmlDocumentLink;

  abstract public function SetTypeItem(string $string) : HtmlDocumentLink;

  abstract public function SetHrefItem(string $string) : HtmlDocumentLink;

  abstract public function SetSizesItem(string $string) : HtmlDocumentLink;

  abstract public function &GetRelArgumentLink() : HtmlArgument;

  abstract public function &GetHrefArgumentLink() : HtmlArgument;

  abstract public function &GetTypeArgumentLink() : HtmlArgument;

  abstract public function &GetSizesArgumentLink() : HtmlArgument;

  abstract public function Generate() : string;
}

abstract class HtmlDocumentScript extends HtmlDocumentHeader
{
  abstract public function __construct();

  abstract public function SetSrcItem(string $string) : HtmlDocumentScript;

  abstract public function SetContent($other) : HtmlDocumentScript;

  abstract public function &GetSizesArgumentLink() : HtmlArgument;

  abstract public function Generate() : string;
}

abstract class HtmlText extends HtmlStaticElement
{
  abstract public function __construct();

  abstract public function SetText(string $string) : HtmlText;

  abstract public function GetText() : string;

  abstract public function Generate() : string;
}

abstract class HtmlQueue extends HtmlStaticElement
{
  abstract public function __construct();

  abstract public function AddItem(Html $item) : HtmlQueue;

  abstract public function GetItems() : array;

  abstract public function Generate() : string;
}

?>