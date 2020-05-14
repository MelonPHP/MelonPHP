<?php

require_once(__DIR__ . "/../Includes/Html.php");
require_once(__DIR__ . "/../Includes/Css.php");

function GetStandartTheme() {
  return (new Theme)
  ->AddBlock(
    (new ThemeBlock)
    ->SetType(ThemeBlock::CoreType)
    ->SetName(
      CommaLine(
        "body", "div", "dl", "dt", "dd", "ul", 
        "ol", "li", "h1", "h2", "h3", "h4", "h5", 
        "h6", "pre", "form", "fieldset", "input", 
        "textarea", "p", "blockquote", "th", 
        "td", "html", "body"
      )
    )
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Margin, Px(0))
      ->AddParameter(Padding, Px(0))
    )
  )
  ->AddBlock(
    (new ThemeBlock)
    ->SetType(ThemeBlock::CoreType)
    ->SetName("table")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(BorderCollapse, Collapse)
      ->AddParameter(BorderSpacing, 0)
    )
  )
  ->AddBlock(
    (new ThemeBlock)
    ->SetType(ThemeBlock::CoreType)
    ->SetName(CommaLine("fieldset", "img"))
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Border, 0)
    )
  )
  ->AddBlock(
    (new ThemeBlock)
    ->SetType(ThemeBlock::CoreType)
    ->SetName("input")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Border, SpaceLine(Px(0), Solid, Hex("b0b0b0")))
    )
  )
  ->AddBlock(
    (new ThemeBlock)
    ->SetType(ThemeBlock::CoreType)
    ->SetName(CommaLine("address", "caption", "cite", "code", "dfn", "th", "var"))
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(FontStyle, Normal)
      ->AddParameter(FontWeight, Normal)
    )
  );
}

