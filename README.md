# HTMLToPHP

> Genereta you Html code from php class tree
>
> Its so simple !!!
>
> Try to Do That 🐱‍💻

## Examples

### Html builder pattern example

This pattern **so simple** and i think you can use this **for small projects** or for **research (teach) this framework**

```php

<?php

// require main.php file
require_once("generator/main.php");

// use this simple pattern like i there
$page = new HtmlBuilder(function () {
  // there you can do some code
  
  // Code ...
  
  // in html builder you always should return Html class or class extended from Html class
  return (new HtmlDocument)
  ->SetTitle("Example page")
  ->SetLanguage("ru")
  ->SetBody(
    // there i use layout Html Column to group elements to column
    (new HtmlColumn)
    ->AddItem(
      (new HtmlText)
      // you can add css there
      ->AddStyleItem(/* css constants */ FontSize, /* in pixels 12 */ Px(26))
      ->SetText("I like coka")
    )
    ->AddItem(
      (new HtmlText)
      // or you can add css class for all html elements who extended from HtmlElement
      ->AddClassItem("small_text")
      ->SetText("... but pepsi is fine too")
    )
  )
});

// generate page
// its like main function or echo function
Html::RunOf(/* there should be HtmlDocument */ $page, /* print debug info or not */ true)

?>

```

### Html builder pattern example with arguments

In this example we add arguments in html builder

```php

<?php

require_once("generator/main.php");

$title = new HtmlBuilder(function () {
  return (new HtmlText)
  // you can add css there
  ->AddStyleItem(FontSize, Px(26))
  ->SetText("I like coka");
});

$text = new HtmlBuilder(function () {
  return (new HtmlText)
  // or you can add css class for all html elements who extended from HtmlElement
  ->AddClassItem("small_text")
  ->SetText("... but pepsi is fine too");
});

// use this simple pattern like i there
$page = new HtmlBuilder(
  // in first argument you can add array (and only array) with arguments 
  array($title, $text), 
  // there shoud be function with one argument and this argument its array from first html builder argument 
  function ($args) {

    // Code ...

    return (new HtmlDocument)
    ->SetTitle("Example page")
    ->SetLanguage("ru")
    ->SetBody(
      // there same code from pre example but with arguments
      (new HtmlColumn)
      ->AddItem($args[0] /* title */)
      ->AddItem($args[1] /* text */)
    )
  }
);

// generate page
// its like main function or echo function
Html::RunOf(/* there HtmlDocument */ $page, /* print debug info or not */ true)

?>

```

### Html components example

If you dream add yourth component you shoud create class and extend this from HtmlComponent

_test_component.php_

```php

<?php

require_once("generator/main.php");

// experements with you class
class MyFistComponent extends HtmlComponent
  private $Text;

  function __construct() {
    // if you create new __construct function, invok please previous __construct
    parent::__construct();
    
    // Code . . .
    
    $this->Text = "";
  }
  
  function SetText(string $text) {
    $this->Text = $text;
    // return this to get this class already
    return $this;
  }
  
  // if you code tree so big, use functions and i recommend add to name of this function 'Build'
  function BuildText() {
    return (new HtmlText)
    ->SetText($this->Text);
  }

  // you should create build function
  function Build () {
    // and you shoud return there Html class
    return (new HtmlContainer)
    ->AddStyle(Margin, Px(25))
    ->SetItem(
      // if you code tree so big, use functions and i recommend add to name of this function Build
      // and invoke there
      $this->BuildText()
    )
  }

?>

```

_test_component_page.php_

```php

require_once("generator/main.php");
// include file with you component
require_once("test_component.php");

$page = new HtmlBuilder(function () {

    // Code ...

    return (new HtmlDocument)
    ->SetTitle("Example page")
    ->SetLanguage("ru")
    ->SetBody(
      // and create your first
      (new MyFistComponent)
      ->SetText("Yo? Hey? A?")
    )
  }
);

// generate page
Html::RunOf(/* there should be HtmlDocument */ $page, true)

```

#

License: [GNU General Public License v3.0](LICENSE)

© 2020 Injective
