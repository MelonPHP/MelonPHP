# Tree PHP

| Browser       | Has Support                                                                |
| ------------- | -------------------------------------------------------------------------- |
| Chromium      | ![#c5f015](https://via.placeholder.com/15/f03c15/000000?text=+) Yes        |
| Safari        | ![#f03c15](https://via.placeholder.com/15/f03c15/000000?text=+) Not        |
| Edge          | ![#edff26](https://via.placeholder.com/15/f03c15/000000?text=+) Partial    |
| EI            | ![#edff26](https://via.placeholder.com/15/f03c15/000000?text=+) Not        |
| Mozilla       | ![#c7c7c7](https://via.placeholder.com/15/f03c15/000000?text=+) Not tested |

## Examples

Simple page

###### _MyPage.php_

```php
<?php

require_once(__DIR__ . "/../frameworks/tree-php/Includes/All.php");

class MyPage extends Component
{
  // like main
  function Build() : GeneratedObject {
    return (new Document)
    ->SetTitle("My page")
    ->SetChild(
      // align childs like column
      (new Column)
      // add childs
      ->AddChild(
        (new Text)
        // add css
        // framework have full css support
        ->AddThemeParameter(FontSize /*parameter name*/, Px(20)/*value. Px(20) equals to 20px*/)
        ->SetText("My title")
      )
      ->AddChild(
        (new Text)
        ->SetText("My text.")
      )
    );
  }
}

// generate and send out page
GeneratedObject::RunOf(new MyPage);

```
###### _Result_

![](/.assets/my_page_example.png)

#

License: [GNU General Public License v3.0](LICENSE)

© 2020
