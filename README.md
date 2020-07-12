# Melon PHP

### Clicker Example

```php

<?php

require_once(__DIR__ . "/Includes/All.php");

// Компонент
class TestPage extends Component
{
  private $TapCount;

  function __construct() {
    parent::____construct();
  
    $this->TapCount = Action::GetValue("click_count", 0 /* standart value */, ActionTypes::Post);
    $this->TapCount++;
  }

  function Build() : Element {
    return Document::Create()
    ->Title("Test page")
    ->Child(
      Action::Create()
      ->Type(ActionTypes::Post)
      ->Varibles(
        ActionVarible::Create()
        ->ActionKey("click_count")
        ->Value($this->TapCount)
      )
      ->Child(
        Column::Create()
        ->ThemeParameter(Padding, Px(15))
        ->Children([
          Text::Create()
          ->ThemeParameter(PaddingBottom, Px(15))
          ->Text("Нажато $this->TapCount раз"),
          Button::Create()
          ->ThemeParameter(Width, Auto)
          ->ThemeParameter(Padding, [Px(4), Px(10)])
          ->ThemeParameter(BackgroundColor, Blue)
          ->ThemeParameter(Color, White)
          ->ThemeParameter(BorderRadius, Px(4))
          ->Text("Нажмите")
        ])
      )
    );
  }
} Node::Run(TestPage::Create());


```

#

License: [GNU General Public License v3.0](LICENSE)

© 2020
