<?php

require_once(__DIR__ . "/../../libs/include_tree-php.php");
require_once(__DIR__ . "/../elements/include.php");

function GetGraverTheme() : Theme {
  return Theme::Create()
  ->ThemeBlocks([
    ThemeBlock::Create()
    ->Keys("graver_list_item")
    ->Modifiers([
      StandartModifier::Create()
      ->Parameter(FontSize, Px(14))
      ->Parameter(Padding, [Px(1), 0]),
      HoverModifier::Create()
      ->Parameter(FontSize, Px(16))
      ->Parameter(Padding, 0)
      ->Parameter(BackgroundColor, Hex("e3e8ec6b"))
      ->Parameter(BorderTop, [Px(1), Solid, Hex("f9f9f9db")])
      ->Parameter(BorderBottom, [Px(1), Solid, Hex("adadadcc")]),
    ]),
    ThemeBlock::Create()
    ->Keys("graver_list_item:active > *")
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(Transition, "all ease 0.2s")
      ->Parameter(Transform, Scale(0.98, 0.96))
      ->Parameter(Filter, Blur(Px(0.5)))
    ),

    ThemeBlock::Create()
    ->Keys("graver_check_line")
    ->Modifiers([
      HoverModifier::Create()
      ->Parameter(BackgroundColor, Hex("3a3a3a12"))
    ]),

    ThemeBlock::Create()
    ->Keys("graver_check_line_link")
    ->Modifiers([
      StandartModifier::Create()
      ->Parameter(Color, Gray),
      HoverModifier::Create()
      ->Parameter(Color, Hex("166edb"))
    ]),

    ThemeBlock::Create()
    ->Keys("graver_field")
    ->Modifiers([
      StandartModifier::Create()
      ->Parameter(Padding, [Px(10),Px(16)])
      ->Parameter(Outline, None)
      ->Parameter(BackgroundColor, Rgba(255, 255, 255, 0.35))
      ->Parameter(Outline, None)
      ->Parameter(Border, [Px(1), Solid, Hex("8c8c8c33")])
      ->Parameter(BorderTop, [Px(1), Solid, White])
      ->Parameter(BorderBottom, [Px(1), Solid, Hex("adadadcc")])
      ->Parameter(BorderRadius, Px(5)),
      (new FocusModifier)
      ->Parameter(Border, [
        Px(1),
        Solid,
        Hex("2294f5")
      ])
      ->Parameter(BorderTop, [
        Px(1),
        Solid,
        Hex("51adf0")
      ])
      ->Parameter(BorderBottom, [
        Px(1),
        Solid,
        Hex("0872c9")
      ]),
    ]),
    
    ThemeBlock::Create()
    ->Keys("graver_add_project_button > * > p")
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(Color, Gray)
      ->Parameter(FontSize, Px(28))
    ),
    ThemeBlock::Create()
    ->Keys("graver_add_project_button:hover > * > p")
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(FontWeight, 300)
      ->Parameter(Color, Hex("166edb"))
    ),

    ThemeBlock::Create()
    ->Keys("graver_project_card")
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(Transition, "all ease 0.5s")
      ->Parameter(BackgroundColor, Hex("d9d9d9"))
      ->Parameter(BorderRadius, Px(5))
      ->Parameter(Border, [Px(1), Solid, Hex("adadad59")])
      ->Parameter(BorderTop, [Px(1), Solid, Hex("ffffffe0")])
      ->Parameter(BorderBottom, [Px(1), Solid, Hex("b3b3b3")])
    )
    ->Modifiers(
      HoverModifier::Create()
      ->Parameter(BorderColor, Hex("119ef7"))
      ->Parameter(Border, [Px(2), Solid, Hex("2294f5")])
      ->Parameter(BorderTop, [Px(2), Solid, Hex("51adf0")])
      ->Parameter(BorderBottom, [Px(2), Solid, Hex("0872c9")])
      ->Parameter(Transform, Scale(1.05, 1.05))
      ->Parameter(Padding, Px(2))
    )
    ->Modifiers(
      (new ActiveModifier)
      ->Parameter(Filter, Blur(Px(0.45)))
      ->Parameter(Transform, Scale(0.999, 0.999))
    ),
    ThemeBlock::Create()
    ->Keys("graver_project_card:hover > div > div")
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(BorderRadius, Px(2))
      ->Parameter(BackdropFilter, Blur(Px(4)))
      ->Parameter(BackgroundColor, Hex("ffffff30"))
      ->Parameter(Webkit(BackdropFilter), Blur(Px(4)))
    ),
    ThemeBlock::Create()
    ->Keys("graver_project_card > div > div")
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(Transition, "all ease 0.8s")
      ->Parameter(BackgroundColor, Hex("ffffff90"))
      ->Parameter(BackdropFilter, Blur(Px(25)))
      ->Parameter(BorderRadius, Px(4))
      ->Parameter(Webkit(BackdropFilter), Blur(Px(25)))
    ),
    ThemeBlock::Create()
    ->Keys("graver_project_card > div")
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(BorderRadius, Px(4))
    ),
    ThemeBlock::Create()
    ->Keys("graver_project_card:hover > div")
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(BorderRadius, Px(2))
    ),

    ThemeBlock::Create()
    ->Keys("graver_button")
    ->Modifiers([
      StandartModifier::Create()
      ->Parameter(Transition, "all ease 0.225s")
      ->Parameter(Color, Black)
      ->Parameter(FontWeight, 500)
      ->Parameter(BackgroundColor, Hex("e3e8ec6b"))
      ->Parameter(Padding, [Px(10),Px(16)])
      ->Parameter(BorderRadius, Px(5))
      ->Parameter(Outline, None)
      ->Parameter(TextDecoration, None)
      ->Parameter(TextAlign, Center)
      ->Parameter(Border, [Px(1), Solid, Hex("8c8c8c33")])
      ->Parameter(BorderTop, [Px(1), Solid, Hex("f9f9f9db")])
      ->Parameter(BorderBottom, [Px(1), Solid, Hex("adadadcc")]),
      HoverModifier::Create()
      ->Parameter(TextDecoration, None)
      ->Parameter(Color, Hex("166edb")),
      (new ActiveModifier)
      ->Parameter(Filter, Blur(Px(0.25)))
      ->Parameter(Transform, Scale(0.975, 0.99))
    ]),

    ThemeBlock::Create()
    ->Keys("graver_card")
    ->Modifiers([
      StandartModifier::Create()
      ->Parameter(Transition, "all ease 0.1s")
      ->Parameter(BorderRadius, Px(4))
      ->Parameter(BorderTop, [
        Px(1),
        Solid,
        Hex("a2a2a2b3")
      ])
      ->Parameter(BorderBottom, [
        Px(1),
        Solid,
        Hex("77777791")
      ]),
      //->Parameter(BackdropFilter, Blur(Px(0)))
      HoverModifier::Create()
      ->Parameter(BackdropFilter, Blur(Px(10)))
      ->Parameter(BackgroundColor, Rgba(255, 255, 255, 0.4))
    ]),
    ThemeBlock::Create()
    ->Keys("graver_card > *")
    ->Modifiers([
      StandartModifier::Create()
      ->Parameter(Display, None)
    ]),
    ThemeBlock::Create()
    ->Keys("graver_card:hover > *")
    ->Modifiers([
      StandartModifier::Create()
      ->Parameter(Display, Block)
    ]),

    ThemeBlock::Create()
    ->Keys("graver_hide_scrollbar")
    ->Modifiers([
      StandartModifier::Create()
      ->Parameter(Overflow, "-moz-scrollbars-none")
      ->Parameter("-ms-overflow-style", None),
      (new WebKitScrollBarModifier)
      ->Parameter(Display, None)
    ]),
    ThemeBlock::Create()
    ->Keys("graver_auth_title")
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(FontSize, Px(100))
      ->Parameter(Color, Hex("fcfcfc"))
    ),
    ThemeBlock::Create()
    ->Keys("graver_auth_form_title")
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(FontWeight, 500)
      ->Parameter(FontSize, Px(30))
    ),
    ThemeBlock::Create()
    ->Keys("on_show_x_translate")
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(Animation, "show_from 0.3s linear 1 alternate-reverse backwards")
    ),

    ThemeBlock::Create()
    ->Keys("on_show_x_large_translate")
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(Animation, "show_from_large 0.3s linear 1 alternate-reverse backwards")
    ),

    ThemeBlock::Create()
    ->Keys("on_show_translate")
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(Animation, [
        "show_from", 
        ".6s",
        "ease-in-out", 
        "alternate-reverse"
      ])
    ),
    ThemeBlock::Create()
    ->Keys("graver_page_background")
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(BackgroundColor, Hex("fcfcfc"))
    ),
    ThemeBlock::Create()
    ->Keys("graver_auth_form_background")
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(BackdropFilter, Blur(Px(30)))
      ->Parameter(Webkit(BackdropFilter), Blur(Px(30)))
      ->Parameter(BackgroundColor, Rgba(255, 255, 255, 0.8))
    ),
    ThemeBlock::Create()
    ->Keys("a")
    ->Type(ThemeBlockTypes::Core)
    ->Modifiers([
      StandartModifier::Create()
      ->Parameter(FontWeight, 500)
      ->Parameter(Color, Hex("166edb"))
      ->Parameter(TextDecoration, None),
      HoverModifier::Create()
      ->Parameter(TextDecoration, Underline),
      (new ActiveModifier)
      ->Parameter(Color, Hex("cc941d"))
    ]),
    ThemeBlock::Create()
    ->Keys("graver_auth_field")
    ->Modifiers([
      StandartModifier::Create()
      ->Parameter(Padding, [Px(0), Px(16)])
      ->Parameter(Outline, None)
      ->Parameter(BackgroundColor, Rgba(255, 255, 255, 0.5))
      ->Parameter(BorderTop, [
        Px(1),
        Solid,
        Hex("ffffffc9")
      ])
      ->Parameter(BorderBottom, [
        Px(1),
        Solid,
        Hex("80808057")
      ])
      ->Parameter(BorderRadius, Px(5))
      ->Parameter(MinHeight, Px(45))
      ->Parameter(MaxHeight, Px(45))
      ->Parameter(Height, Px(45)),
      (new FocusModifier)
      ->Parameter(Padding, [Px(0), Px(15)])
      ->Parameter(Border, [
        Px(1),
        Solid,
        Hex("2294f5")
      ])
      ->Parameter(BorderTop, [
        Px(1),
        Solid,
        Hex("51adf0")
      ])
      ->Parameter(BorderBottom, [
        Px(1),
        Solid,
        Hex("0872c9")
      ]),
    ]),
    ThemeBlock::Create()
    ->Keys("graver_auth_button")
    ->Modifiers([
      StandartModifier::Create()
      ->Parameter(Transition, "all ease 0.3s")
      ->Parameter(Color, Hex("166edb"))
      ->Parameter(FontWeight, 500)
      ->Parameter(Background, "linear-gradient(0.25turn, #c5c5c57a, #c5c5c57a)")
      ->Parameter(Padding, [
        Px(0),
        Px(16)
      ])
      ->Parameter(BorderRadius, Px(5))
      ->Parameter(Outline, None)
      ->Parameter(MinHeight, Px(45))
      ->Parameter(MaxHeight, Px(45))
      ->Parameter(Height, Px(45))
      //->Parameter(Border, [Px(1), Solid, Transparent])
      ->Parameter(BorderTop, [
        Px(1),
        Solid,
        Hex("f1f1f1bf")
      ])
      ->Parameter(BorderBottom, [
        Px(1),
        Solid,
        Hex("80808057")
      ]),
      HoverModifier::Create()
      ->Parameter(Background, "linear-gradient(0.25turn, #c5c5c57a, #c5c5c5)")
      ->Parameter(Color, White),
      (new ActiveModifier)
      ->Parameter(Filter, Blur(Px(0.75)))
      ->Parameter(Transform, Scale(0.975, 0.99))
    ]),
    ThemeBlock::Create()
    ->Keys("graver_shake_error_text")
    ->Modifiers(
      StandartModifier::Create()
      ->Parameter(Color, Red)
      ->Parameter(Animation, ["graver_shake_text_keys", ".2s", "ease-in-out", "5", "alternate-reverse"])
    )
  ])
  ->FrameBlocks([
    FrameBlock::Create()
    ->Key("graver_shake_text_keys")
    ->Frames([
      (new Frame)
      ->Value(Pr(0))
      ->Parameter(Transform, Translate(0, 0)),
      (new Frame)
      ->Value(Pr(25))
      ->Parameter(Color, Hex("ff4040"))
      ->Parameter(Filter, Blur(Px(0.5))),
      (new Frame)
      ->Value(Pr(50))
      ->Parameter(Filter, Blur(Px(1.2))),
      (new Frame)
      ->Value(Pr(75))
      ->Parameter(Color, Hex("ff4040"))
      ->Parameter(Filter, Blur(Px(0.5))),
      (new Frame)
      ->Value(Pr(100))
      ->Parameter(Transform, Translate(Px(10), 0)),
    ]),
    FrameBlock::Create()
    ->Key("show_from")
    ->Frames([
      (new Frame)
      ->Value(Pr(50))
      ->Parameter(Opacity, 1),
      (new Frame)
      ->Value(Pr(100))
      ->Parameter(Opacity, 0),
      (new Frame)
      ->Value(To)
      ->Parameter(Transform, Scale(0.9, 0.9))
      ->Parameter(Filter, Blur(Px(1.75)))
    ]),
    FrameBlock::Create()
    ->Key("show_from_large")
    ->Frames([
      (new Frame)
      ->Value(Pr(50))
      ->Parameter(Opacity, 1),
      (new Frame)
      ->Value(Pr(100))
      ->Parameter(Opacity, 0),
      (new Frame)
      ->Value(To)
      ->Parameter(Transform, Scale(0.97, 0.97))
      ->Parameter(Filter, Blur(Px(1.75)))
    ])
  ]);
}