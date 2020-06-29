<?php

require_once(__DIR__ . "/../Includes/Styles.php");

function GetElementsTheme() : Theme {
  return (new Theme)
  ->ThemeBlocks([

    (new ThemeBlock)
    ->Keys(["__text"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(FontSize, Px(14))
      //->Parameter(WebKit(UserSelect), None)
      //->Parameter(Moz(UserSelect), None)
      //->Parameter(UserSelect, None)
      ->Parameter(FontFamily, CommaLine([
        "'Segoe UI'", "Frutiger", 
        "'Frutiger Linotype'", 
        "'Dejavu Sans'", "'Helvetica Neue'", 
        "Arial", "sans-serif"
      ]))
    ]),

    (new ThemeBlock)
    ->Keys(["__text_no_select"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(WebKit(UserSelect), None)
      ->Parameter(Moz(UserSelect), None)
      ->Parameter(UserSelect, None)
    ]),

    (new ThemeBlock)
    ->Keys(["__hover_cursor"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Cursor, Pointer)
      ->Parameter(Webkit(Cursor), "hand")
    ]),

    (new ThemeBlock)
    ->Keys(["__text_cursor"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Cursor, Text)
    ]),

    (new ThemeBlock)
    ->Keys(["__layout_queue"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Width, Pr(100))
      ->Parameter(Height, Pr(100))
      ->Parameter(FlexShrink, 0)
      ->Parameter(Left, 0)
      ->Parameter(Flex, Auto)
      ->Parameter(Display, WebKit(Flex))
      ->Parameter(Display, Flex)
      ->Parameter(JustifyContent, FlexStart)
      ->Parameter(AlignItems, Left)
    ]),

    (new ThemeBlock)
    ->Keys(["__ly_row"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(FlexDirection, Row)
      ->Parameter(WebKit(FlexDirection), Row)
    ]),

    (new ThemeBlock)
    ->Keys(["__ly_column"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(FlexDirection, Column)
      ->Parameter(WebKit(FlexDirection), Column)
    ]),

    (new ThemeBlock)
    ->Keys(["__ly_grid"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Width, Pr(100))
      ->Parameter(Height, Pr(100))
      ->Parameter(Display, Grid)
    ]),

    (new ThemeBlock)
    ->Keys(["__ly_container"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Width, Pr(100))
      ->Parameter(Height, Pr(100))
      ->Parameter(Display, Block)
    ]),

    (new ThemeBlock)
    ->Keys(["__ly_stack"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Position, Absolute)
    ]),

    (new ThemeBlock)
    ->Keys(["__center"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Margin, Auto)
    ]),

    (new ThemeBlock)
    ->Keys(["__sc_vertical"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(OverflowX, Hidden)
      ->Parameter(OverflowY, Auto)
    ]),

    (new ThemeBlock)
    ->Keys(["__sc_horizontal"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(OverflowX, Auto)
      ->Parameter(OverflowY, Hidden)
    ]),

    (new ThemeBlock)
    ->Keys(["__sc_all"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(OverflowX, Auto)
      ->Parameter(OverflowY, Auto)
    ]),

    (new ThemeBlock)
    ->Keys(["__button"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Width, Pr(100))
    ]),

    (new ThemeBlock)
    ->Keys(["__field"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Width, Pr(100))
    ]),
    
    (new ThemeBlock)
    ->Keys(["__ly_stack"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Position, Relative)
    ]),

    (new ThemeBlock)
    ->Keys(["__ly_stack_item"])
    ->Modifiers([
      (new StandartModifier)
      ->Parameter(Position, Absolute)
    ])
  ]);
}

