# Melon PHP

> Simple HTML and CSS generator like flutter but for PHP

## Examples

### Clicker Example

###### code:

```php

<?php

require_once(__DIR__ . "/Includes/All.php");

class ClickerDisplay extends DisplayComponent
{
  private $TapCount;

  function Initialize() {
    $this->TapCount = Action::GetValue("click_count", 0 /* standart value */, ActionTypes::Post);
    $this->TapCount++;
  }

  function Build() : Element {
    return Document::Create()
    ->Title("Test page")
    ->Child(
      Action::Create()
      ->Type(ActionTypes::Post)
      ->Variable("click_count", $this->TapCount)
      ->Child(
        Column::Create()
        ->ThemeParameter(Padding, Px(15))
        ->Children([
          Text::Create()
          ->ThemeParameter(PaddingBottom, Px(15))
          ->Text("Press $this->TapCount times"),
          Button::Create()
          ->ThemeParameter(Width, Auto)
          ->ThemeParameter(Padding, [Px(4), Px(10)])
          ->ThemeParameter(BackgroundColor, Blue)
          ->ThemeParameter(Color, White)
          ->ThemeParameter(BorderRadius, Px(4))
          ->Text("Press")
        ])
      )
    );
  }
} ClickerDisplay::Display();


```

###### result:

![](https://github.com/MelonPHP/MelonPHP/blob/stable/.assets/ex_1.png)

### Layouts Example

###### code:

```php

<?php

require_once(__DIR__ . "/Includes/All.php");

class TestPage extends PageComponent
{

  function BuildRow() {
    return Row::Create()
    ->ThemeParameter(Width, Px(700))
    ->ThemeParameter(Height, Px(700))
    ->ThemeParameter(Border, [Px(1), Solid, Black])
    ->Children([
      Container::Create()
      ->ThemeParameter(BackgroundColor, Red)
      ->ThemeParameter(Width, Pr(50)),
      Container::Create()
      ->ThemeParameter(BackgroundColor, Green),
    ]);
  }

  function BuildColumn() {
    return Column::Create()
    ->ThemeParameter(Width, Px(700))
    ->ThemeParameter(Height, Px(700))
    ->ThemeParameter(Border, [Px(1), Solid, Black])
    ->Children([
      Container::Create()
      ->ThemeParameter(BackgroundColor, Red),
      Container::Create()
      ->ThemeParameter(BackgroundColor, Green),
    ]);
  }

  function Build() : Element {
    return Document::Create()
    ->Title("Test page")
    ->Child(
      Stack::Create()
      ->Children([
        Container::Create()
        ->ThemeParameter(PaddingLeft, Px(100))
        ->ThemeParameter(PaddingTop, Px(100))
        ->Child($this->BuildColumn()),
        Container::Create()
        ->ThemeParameter(PaddingLeft, Px(200))
        ->ThemeParameter(PaddingTop, Px(200))
        ->Child($this->BuildRow()),
      ])
    );
  }
} TestPage::Display();

```

###### result:

![](https://github.com/MelonPHP/MelonPHP/blob/stable/.assets/ex_2.png)

### Align Example

###### code:

```php

<?php

require_once(__DIR__ . "/Includes/All.php");

class TestPage extends PageComponent
{

  function BuildColumn($color) : Column {
    return Column::Create()
    ->ThemeParameter(BackgroundColor, $color)
    ->Children([
      Text::Create()
      ->Text("Hello Melon PHP"),
      Text::Create()
      ->Text("Hello Melon PHP")
    ]);
  }

  function BuildCenterScretchBetween($color) {
    return $this->BuildColumn($color)
    ->CrossAlign(CrossAxisAligns::Scretch)
    ->MainAlign(MainAxisAligns::Between);
  }

  function BuildCenterStartEnd($color) {
    return $this->BuildColumn($color)
    ->CrossAlign(CrossAxisAligns::Start)
    ->MainAlign(MainAxisAligns::End);
  }

  function BuildCenterCenterEnd($color) {
    return $this->BuildColumn($color)
    ->CrossAlign(CrossAxisAligns::Center)
    ->MainAlign(MainAxisAligns::End);
  }

  function BuildCenterCenter($color) {
    return $this->BuildColumn($color)
    ->CrossAlign(CrossAxisAligns::Center)
    ->MainAlign(MainAxisAligns::Center);
  }

  function Build() : Element {
    return Document::Create()
    ->Title("Test page")
    ->Child(
      Row::Create()
      ->Children([
        Column::Create()
        ->Children([
          $this->BuildCenterStartEnd(Red),
          $this->BuildCenterCenterEnd(Blue)
        ]),
        Column::Create()
        ->Children([
          $this->BuildCenterCenter(Green),
          $this->BuildCenterScretchBetween(Red)
        ])
      ])
    );
  }
} TestPage::Display();


```

###### result:

![](https://github.com/MelonPHP/MelonPHP/blob/stable/.assets/ex_3.png)

#

License: [GNU General Public License v3.0](LICENSE)

© 2020
