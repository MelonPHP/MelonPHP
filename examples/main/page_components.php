<?php

require_once("generator/html.php");

class TopBarItemComponent extends HtmlComponent
{
  private $Title;
  private $Link;
  public function __construct($title, $link) {
    $this->InitializeHtml();
    $this->Title = $title;
    $this->Link = $link;
  }

  function Build() {
    return (new HtmlLink)
    ->AddStyleItem("width", "100%")
    ->AddClassItem("top_bar_item_link")
    ->SetLink($this->Link)
    ->SetItem(
      (new HtmlColumn)
      ->SetCrossAligment(HtmlCrossAxisAligment::Center)
      ->SetMainAligment(HtmlMainAxisAligment::Center)
      ->AddItem(
        (new HtmlText)
        ->AddClassItem("top_bar_item_text")
        ->SetText($this->Title)
      )
    );
  }
}

class TopBarComponent extends HtmlComponent
{
  const TITLES = array(
    "Home" => "#",
    "Documentation" => "#",
    "Examples" => "#",
    "About" => "#",
  );

  public function __construct() {
    $this->InitializeHtml();
  }

  function BuildTitle() {
    return (new HtmlContainer)
    ->AddStyleItem("margin", "0 10px")
    ->SetItem(
      (new HtmlText)
      ->AddClassItem("top_bar_title")
      ->SetText("Generator")
    );
  }

  function BuildDesktop() {
    $itemsRow = new HtmlRow;
    foreach (TopBarComponent::TITLES as $key => $value) {
      $itemsRow
      ->AddItem(new TopBarItemComponent($key, $value));
    }
    return (new HtmlRow)
    ->SetCrossAligment(HtmlCrossAxisAligment::Center)
    ->AddItem($this->BuildTitle())
    ->AddItem($itemsRow);
  }

  function BuildMobile() {
    $itemsColumn = new HtmlColumn;
    foreach (TopBarComponent::TITLES as $key => $value) {
      $itemsColumn
      ->AddItem(new TopBarItemComponent($key, $value));
    }
    return (new HtmlColumn)
      ->SetCrossAligment(HtmlCrossAxisAligment::Center)
      ->AddItem(
        (new HtmlContainer)
        ->AddStyleItem("width", "auto")
        ->SetItem(
          $this->BuildTitle()
          ->AddStyleItem("margin", "16px 0")
          ->AddStyleItem("text-align", "center")
        )
      )
      ->AddItem(new HtmlBuilder(array($itemsColumn), function ($args) {
        $args[0]->Context->SetId("top_bar_m");
        return $args[0];
      })
    );
  }

  function Build() {
    return (new HtmlContainer)
    ->AddClassItem("top_bar")
    ->SetItem(
      (new HtmlCenterContainer)
      ->AddStyleItem("max-width", "800px")
      ->SetItem(
        (new HtmlQueue)
        ->AddItem(
          $this->BuildDesktop()
          ->AddClassItem("top_bar_item_layout_state_desktop")
        )
        ->AddItem(
          $this->BuildMobile()
          ->AddClassItem("top_bar_item_layout_state_mobile")
        )
      )
    );
  }
}

class MainPage extends HtmlComponent
{
  const CSS_LINK = "http://localhost/test/custom.css";

  private $Child;

  public function __construct($child) {
    $this->InitializeHtml();
    $this->Child = $child;
  }

  private $scrollScript = "
    var preScrollPos = window.pageYOffset;
    window.onscroll = function() {
      var currentScrollPos = window.pageYOffset;
      if (currentScrollPos < preScrollPos) {
        document.getElementById(\"top_bar_m\").style.display = \"flex\";
      } else {
        document.getElementById(\"top_bar_m\").style.display = \"none\";
      }
      preScrollPos = window.pageYOffset;
    }
  ";

  function Build() {
    return (new HtmlDocument)
    ->AddHeader(
      (new HtmlDocumentLink)
      ->SetRelItem("stylesheet")
      ->SetTypeItem("text/css")
      ->SetHrefItem(MainPage::CSS_LINK)
    )
    ->AddHeader(
      (new HtmlDocumentMeta)
      ->SetNameItem("viewport")
      ->SetContentItem("width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0")
    )
    ->AddStyleItem("background-color", "#f5f5f5")
    ->SetBody(
      (new HtmlQueue)
      ->AddItem(new TopBarComponent)
      ->AddItem(
        (new HtmlContainer)
        ->AddStyleItem("padding", "75px 0 0 0")
        ->SetItem($this->Child)
      )
      ->AddItem(
        (new HtmlDocumentScript)
        ->SetContent($this->scrollScript)
      )
    );
  }
}

?>