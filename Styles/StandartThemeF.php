<?php

require_once(__DIR__ . "/../Includes/Styles.php");

function GetStandartTheme() : Theme {
  return (new Theme)
  ->AddThemeBlocks([

    (new ThemeBlock)
    ->SetType(ThemeBlockTypes::Core)
    ->SetKeys([
      "body", "div", "dl", "dt", "dd", "ul", 
      "ol", "li", "h1", "h2", "h3", "h4", "h5", 
      "h6", "pre", "form", "fieldset", "input", 
      "textarea", "p", "blockquote", "th", 
      "td", "html", "body"
    ])
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Margin, Px(0))
      ->AddParameter(Padding, Px(0))
    ),

    (new ThemeBlock)
    ->SetType(ThemeBlockTypes::Core)
    ->SetKey("table")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(BorderCollapse, Collapse)
      ->AddParameter(BorderSpacing, 0)
    ),

    (new ThemeBlock)
    ->SetType(ThemeBlockTypes::Core)
    ->SetKeys(["fieldset", "img"])
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Border, 0)
    ),

    (new ThemeBlock)
    ->SetType(ThemeBlockTypes::Core)
    ->SetKey("input")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Border, [Px(0), Solid, Hex("b0b0b0")])
    ),

    (new ThemeBlock)
    ->SetType(ThemeBlockTypes::Core)
    ->SetKeys(["address", "caption", "cite", "code", "dfn", "th", "var"])
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(FontStyle, Normal)
      ->AddParameter(FontWeight, Normal)
    ),

    (new ThemeBlock)
    ->SetType(ThemeBlockTypes::Core)
    ->SetKeys(["ol", "ul"])
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(ListStyle, None)
    ),

    (new ThemeBlock)
    ->SetType(ThemeBlockTypes::Core)
    ->SetKeys(["caption", "th"])
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(TextAlign, Left)
    ),

    (new ThemeBlock)
    ->SetType(ThemeBlockTypes::Core)
    ->SetKeys(["h1", "h2", "h3", "h4", "h5", "h6"])
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(FontSize, Pr(100))
      ->AddParameter(FontWeight, Normal)
    ),

    (new ThemeBlock)
    ->SetType(ThemeBlockTypes::Core)
    ->SetKey("q")
    ->AddModifiers([
      (new BeforeModifier)
      ->AddParameter(Content, ""),
      (new AfterModifier)
      ->AddParameter(Content, "")
    ]),

    (new ThemeBlock)
    ->SetType(ThemeBlockTypes::Core)
    ->SetKeys(["abbr", "acronym"])
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Border, 0)
    ),

    (new ThemeBlock)
    ->SetKeys(["input", "textarea", "button", "select", "a"])
    ->SetType(ThemeBlockTypes::Core)
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter("-webkit-tap-highlight-color", Transparent)
    ),

    (new ThemeBlock)
    ->SetType(ThemeBlockTypes::Core)
    ->SetKey("*")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Cursor, Defualt)
      ->AddParameter(BoxSizing, BorderBox)
    ),

    (new ThemeBlock)
    ->SetType(ThemeBlockTypes::Core)
    ->SetKey("html")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Position, Relative)
      ->AddParameter(Height, Pr(100))
    ),

    (new ThemeBlock)
    ->SetType(ThemeBlockTypes::Core)
    ->SetKey("body")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Position, Fixed)
      ->AddParameter(Top, 0)
      ->AddParameter(Left, 0)
      ->AddParameter(Height, Pr(100))
      ->AddParameter(Width, Pr(100))
    )
  ]);
}