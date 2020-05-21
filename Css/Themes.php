<?php

require_once(__DIR__ . "/../Includes/Css.php");

function GetStandartTheme() {
  return (new Theme)
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetType(ThemeBlock::CoreType)
    ->SetKey(
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
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetType(ThemeBlock::CoreType)
    ->SetKey("table")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(BorderCollapse, Collapse)
      ->AddParameter(BorderSpacing, 0)
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetType(ThemeBlock::CoreType)
    ->SetKey(CommaLine("fieldset", "img"))
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Border, 0)
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetType(ThemeBlock::CoreType)
    ->SetKey("input")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Border, SpaceLine(Px(0), Solid, Hex("b0b0b0")))
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetType(ThemeBlock::CoreType)
    ->SetKey(CommaLine("address", "caption", "cite", "code", "dfn", "th", "var"))
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(FontStyle, Normal)
      ->AddParameter(FontWeight, Normal)
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetType(ThemeBlock::CoreType)
    ->SetKey(CommaLine("ol", "ul"))
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(ListStyle, None)
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetType(ThemeBlock::CoreType)
    ->SetKey(CommaLine("caption", "th"))
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(TextAlign, Left)
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetType(ThemeBlock::CoreType)
    ->SetKey(CommaLine("h1", "h2", "h3", "h4", "h5", "h6"))
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(FontSize, Pr(100))
      ->AddParameter(FontWeight, Normal)
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetType(ThemeBlock::CoreType)
    ->SetKey("q")
    ->AddModifier(
      (new BeforeModifier)
      ->AddParameter(Content, "")
    )
    ->AddModifier(
      (new AfterModifier)
      ->AddParameter(Content, "")
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetType(ThemeBlock::CoreType)
    ->SetKey(CommaLine("abbr", "acronym"))
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Border, 0)
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetType(ThemeBlock::CoreType)
    ->SetKey("*")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(BoxSizing, BorderBox)
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetType(ThemeBlock::CoreType)
    ->SetKey(CommaLine("html", "body"))
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Position, Relative)
      ->AddParameter(Height, Pr(100))
    )
  );
}

function GetElementsTheme() {
  return (new Theme)
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetKey("__text")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(FontSize, Px(14))
      ->AddParameter(WebKit(UserSelect), None)
      ->AddParameter(Moz(UserSelect), None)
      ->AddParameter(UserSelect, None)
      ->AddParameter(FontFamily, CommaLine(
        "'Segoe UI'", "Frutiger", "'Frutiger Linotype'", "'Dejavu Sans'", "'Helvetica Neue'", "Arial", "sans-serif"
      ))
    )
  )
  ->AddThemeBlock(
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
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetKey("__ly_row")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(FlexDirection, Row)
      ->AddParameter(WebKit(FlexDirection), Row)
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetKey("__ly_column")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(FlexDirection, Column)
      ->AddParameter(WebKit(FlexDirection), Column)
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetKey("__ly_grid")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Width, Pr(100))
      ->AddParameter(Height, Pr(100))
      ->AddParameter(Display, Grid)
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetKey("__ly_container")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Width, Pr(100))
      ->AddParameter(Height, Pr(100))
      ->AddParameter(Display, Block)
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetKey("__ly_stack")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Position, Absolute)
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetKey("__center")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Margin, Auto)
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetKey("__sc_vertical")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(OverflowX, Hidden)
      ->AddParameter(OverflowY, Auto)
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetKey("__sc_horizontal")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(OverflowX, Auto)
      ->AddParameter(OverflowY, Hidden)
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetKey("__sc_all")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(OverflowX, Auto)
      ->AddParameter(OverflowY, Auto)
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetKey("__button")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Width, Pr(100))
    )
  )
  ->AddThemeBlock(
    (new ThemeBlock)
    ->SetKey("__field")
    ->AddModifier(
      (new StandartModifier)
      ->AddParameter(Width, Pr(100))
    )
  );
}

