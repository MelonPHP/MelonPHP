<?php

require_once("generator/html.php");
require_once("page_components.php");

$testListChild = new HtmlBuilder(function () {
  return (new HtmlCenterContainer)
  ->AddStyleItem("max-width", "800px")
  ->AddStyleItem("z-index", "0")
  ->SetItem(
    new HtmlBuilder(function () {
      $items = new HtmlColumn;
      for ($i=0; $i < 30; $i++) { 
        $items->AddItem(
          (new HtmlContainer)
          ->AddStyleItem("margin", "30px 0")
          ->AddStyleItem("height", "300px")
          ->AddStyleItem("width", "100%")
          ->AddStyleItem("background-image", "url(https://www.hdwallpapers.net/previews/road-trip-on-a-stormy-day-canada-239.jpg)")
          ->SetItem((new HtmlText))
        );
      }
      return $items;
    })
  );
});

Html::RunOf(new MainPage($testListChild), true);

?>