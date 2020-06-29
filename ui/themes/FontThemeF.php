<?php

require_once(__DIR__ . "/../../libs/include_tree-php.php");

function GetFontsTheme() : Theme {
  return Theme::Create()
  ->ThemeBlocks(
    ThemeBlock::Create()
    ->Keys("font-face")
    ->Type(ThemeBlockTypes::Link)
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(FontFamily, "'Material Icons'")
      ->Parameter(FontStyle, Normal)
      ->Parameter(FontWeight, 400)
      ->Parameter("src", [
        Url("https://fonts.gstatic.com/s/materialicons/v50/flUhRq6tzZclQEJ-Vdg-IuiaDsNcIhQ8tQ.woff2"),
        Format("'woff2'")
      ])
    )
  )
  ->ThemeBlocks(
    ThemeBlock::Create()
    ->Keys("material_icons")
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(FontFamily, "'Material Icons'")
      ->Parameter(FontWeight, Normal)
      ->Parameter(FontStyle, Normal)
      // Preferred icon size.
      ->Parameter(FontSize, Px(24))
      ->Parameter(Display, InlineBlock)
      ->Parameter(LineHeight, 1)
      ->Parameter(TextTransform, None)
      ->Parameter(LetterSpacing, Normal)
      ->Parameter(WordWrap, Normal)
      ->Parameter(WhiteSpace, NoWrap)
      ->Parameter(Direction, LTR)
      // Support for all WebKit browsers.
      ->Parameter(WebKit(FontSmoothing), Antialiased)
      // Support for Safari and Chrome.
      ->Parameter(TextRendering, OptimizeLegibility)
      // Support for IE.
      ->Parameter(FontFeatureSettings, "'liga'")
    )
  );
}