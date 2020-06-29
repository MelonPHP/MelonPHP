<?php

require_once(__DIR__ . "/../Includes/Styles.php");

function GetStandartTheme() : Theme {
  return (new Theme)
  ->ThemeBlocks([

    (new ThemeBlock)
    ->Type(ThemeBlockTypes::Core)
    ->Keys([
      "body", "div", "dl", "dt", "dd", "ul", 
      "ol", "li", "h1", "h2", "h3", "h4", "h5", 
      "h6", "pre", "form", "fieldset", "input", 
      "textarea", "p", "blockquote", "th", 
      "td", "html", "body"
    ])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Margin, Px(0))
      ->Parameter(Padding, Px(0))
    ]),

    (new ThemeBlock)
    ->Type(ThemeBlockTypes::Core)
    ->Keys(["table"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(BorderCollapse, Collapse)
      ->Parameter(BorderSpacing, 0)
    ]),

    (new ThemeBlock)
    ->Type(ThemeBlockTypes::Core)
    ->Keys(["fieldset", "img"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Border, 0)
    ]),

    (new ThemeBlock)
    ->Type(ThemeBlockTypes::Core)
    ->Keys(["input"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Border, [Px(0), Solid, Hex("b0b0b0")])
    ]),

    (new ThemeBlock)
    ->Type(ThemeBlockTypes::Core)
    ->Keys(["address", "caption", "cite", "code", "dfn", "th", "var"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(FontStyle, Normal)
      ->Parameter(FontWeight, Normal)
    ]),

    (new ThemeBlock)
    ->Type(ThemeBlockTypes::Core)
    ->Keys(["ol", "ul"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(ListStyle, None)
    ]),

    (new ThemeBlock)
    ->Type(ThemeBlockTypes::Core)
    ->Keys(["caption", "th"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(TextAlign, Left)
    ]),

    (new ThemeBlock)
    ->Type(ThemeBlockTypes::Core)
    ->Keys(["h1", "h2", "h3", "h4", "h5", "h6"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(FontSize, Pr(100))
      ->Parameter(FontWeight, Normal)
    ]),

    (new ThemeBlock)
    ->Type(ThemeBlockTypes::Core)
    ->Keys(["q"])
    ->Modifiers([
      (new BeforeModifier)
      ->Parameter(Content, ""),
      (new AfterModifier)
      ->Parameter(Content, "")
    ]),

    (new ThemeBlock)
    ->Type(ThemeBlockTypes::Core)
    ->Keys(["abbr", "acronym"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Border, 0)
    ]),

    (new ThemeBlock)
    ->Keys(["input", "textarea", "button", "select", "a"])
    ->Type(ThemeBlockTypes::Core)
    ->Modifiers([
      (new StandartModifier)
      ->Parameter("-webkit-tap-highlight-color", Transparent)
    ]),

    (new ThemeBlock)
    ->Type(ThemeBlockTypes::Core)
    ->Keys(["*"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Cursor, Defualt)
      ->Parameter(BoxSizing, BorderBox)
    ]),

    (new ThemeBlock)
    ->Type(ThemeBlockTypes::Core)
    ->Keys(["html"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Position, Relative)
      ->Parameter(Height, Pr(100))
    ]),

    (new ThemeBlock)
    ->Type(ThemeBlockTypes::Core)
    ->Keys(["body"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Position, Fixed)
      ->Parameter(Top, 0)
      ->Parameter(Left, 0)
      ->Parameter(Height, Pr(100))
      ->Parameter(Width, Pr(100))
    ]),
  ]);
}