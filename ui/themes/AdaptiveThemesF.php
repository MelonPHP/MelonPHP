<?php

require_once(__DIR__ . "/../../libs/include_tree-php.php");

function GetAdaptiveThemes() : array {
  return Queue::Create()
  ->Children([
    // ALl
    Theme::Create()
    ->ThemeBlocks(
      ThemeBlock::Create()
      ->Keys("adaptive_dialog")
      ->Modifiers(
        StandartModifier::Create()
        ->Parameter(Height, Auto)
        ->Parameter(MaxWidth, Px(600))
      ),
    )
    ->ThemeBlocks(
      ThemeBlock::Create()
      ->Keys("graver_project_left")
      ->Modifiers(
        StandartModifier::Create()
        ->Parameter(Width, Px(300))
        ->Parameter(MaxWidth, Px(300))
        ->Parameter(MinWidth, Px(300))
      ),
    )
    ->ThemeBlocks(
      ThemeBlock::Create()
      ->Keys("graver_project_right")
      ->Modifiers(
        StandartModifier::Create()
        ->Parameter(Width, Pr(100))
      ),
    ),
    Theme::Create()
    ->MaxWidth(Px(600))
    ->ThemeBlocks(
      ThemeBlock::Create()
      ->Keys("graver_project")
      ->Modifiers(
        StandartModifier::Create()
        ->Parameter(Width, Pr(100))
        ->Parameter(MinWidth, Pr(100))
        ->Parameter(MaxWidth, Pr(100))
      )
    ),
    // MOBILE
    Theme::Create()
    ->MaxWidth(Px(800))
    ->ThemeBlocks([
      ThemeBlock::Create()
      ->Keys("not_mobile")
      ->Modifiers(
        StandartModifier::Create()
        ->Parameter(Display, None)
      ),
      ThemeBlock::Create()
      ->Keys("adaptive_dialog")
      ->Modifiers(
        StandartModifier::Create()
        ->Parameter(Height, Pr(100))
        ->Parameter(MaxWidth, Pr(100))
      ),
    ]),
    /// TABLET
    Theme::Create()
    ->MinWidth(Px(800))
    ->MaxWidth(Px(1200))
    ->ThemeBlocks([
      ThemeBlock::Create()
      ->Keys("not_tablet")
      ->Modifiers(
        StandartModifier::Create()
        ->Parameter(Display, None)
      ),
      ThemeBlock::Create()
      ->Keys("graver_left_auth_title")
      ->Modifiers(
        StandartModifier::Create()
        ->Parameter(FontSize, Px(80))
      ),
      ThemeBlock::Create()
      ->Keys("graver_left_auth_picture")
      ->Modifiers(
        StandartModifier::Create()
        ->Parameter(Width, Pr(50))
      )
    ]),
    /// DESKTOP
    Theme::Create()
    ->MinWidth(Px(1200))
    ->ThemeBlocks(
      ThemeBlock::Create()
      ->Keys("not_desktop")
      ->Modifiers(
        StandartModifier::Create()
        ->Parameter(Display, None)
      )
    )
  ])
  ->GetChildren();
}