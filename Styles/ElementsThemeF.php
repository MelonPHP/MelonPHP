<?php

require_once(__DIR__ . "/../Includes/Styles.php");

function GetElementsTheme() : Theme {
  return (new Theme)
  ->AddThemeBlocks([

    (new ThemeBlock)
    ->SetKey("__text")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(FontSize, Px(14))
      //->AddParameter(WebKit(UserSelect), None)
      //->AddParameter(Moz(UserSelect), None)
      //->AddParameter(UserSelect, None)
      ->AddParameter(FontFamily, CommaLine([
        "'Segoe UI'", "Frutiger", 
        "'Frutiger Linotype'", 
        "'Dejavu Sans'", "'Helvetica Neue'", 
        "Arial", "sans-serif"
      ]))
    ),

    (new ThemeBlock)
    ->SetKey("__text_no_select")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(WebKit(UserSelect), None)
      ->AddParameter(Moz(UserSelect), None)
      ->AddParameter(UserSelect, None)
    ),

    (new ThemeBlock)
    ->SetKey("__hover_cursor")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Cursor, Pointer)
      ->AddParameter(Webkit(Cursor), "hand")
    ),

    (new ThemeBlock)
    ->SetKey("__text_cursor")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Cursor, Text)
    ),

    (new ThemeBlock)
    ->SetKey("__layout_queue")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Width, Pr(100))
      ->AddParameter(Height, Pr(100))
      ->AddParameter(FlexShrink, 0)
      ->AddParameter(Left, 0)
      ->AddParameter(Flex, Auto)
      ->AddParameter(Display, WebKit(Flex))
      ->AddParameter(Display, Flex)
      ->AddParameter(JustifyContent, FlexStart)
      ->AddParameter(AlignItems, Left)
    ),

    (new ThemeBlock)
    ->SetKey("__ly_row")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(FlexDirection, Row)
      ->AddParameter(WebKit(FlexDirection), Row)
    ),

    (new ThemeBlock)
    ->SetKey("__ly_column")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(FlexDirection, Column)
      ->AddParameter(WebKit(FlexDirection), Column)
    ),

    (new ThemeBlock)
    ->SetKey("__ly_grid")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Width, Pr(100))
      ->AddParameter(Height, Pr(100))
      ->AddParameter(Display, Grid)
    ),

    (new ThemeBlock)
    ->SetKey("__ly_container")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Width, Pr(100))
      ->AddParameter(Height, Pr(100))
      ->AddParameter(Display, Block)
    ),

    (new ThemeBlock)
    ->SetKey("__ly_stack")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Position, Absolute)
    ),

    (new ThemeBlock)
    ->SetKey("__center")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Margin, Auto)
    ),

    (new ThemeBlock)
    ->SetKey("__sc_vertical")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(OverflowX, Hidden)
      ->AddParameter(OverflowY, Auto)
    ),

    (new ThemeBlock)
    ->SetKey("__sc_horizontal")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(OverflowX, Auto)
      ->AddParameter(OverflowY, Hidden)
    ),

    (new ThemeBlock)
    ->SetKey("__sc_all")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(OverflowX, Auto)
      ->AddParameter(OverflowY, Auto)
    ),

    (new ThemeBlock)
    ->SetKey("__button")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Width, Pr(100))
    ),

    (new ThemeBlock)
    ->SetKey("__field")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Width, Pr(100))
    ),
    
    (new ThemeBlock)
    ->SetKey("__ly_stack")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Position, Relative)
    ),

    (new ThemeBlock)
    ->SetKey("__ly_stack_item")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Position, Absolute)
    )
  ]);
}

