# HTMLToPHP

Genereta Html from php class tree

## Example

```php

<?php

// require main.php file
require_once("generator/main.php");

// use this simple pattern like i there
$page = new HtmlBuilder(function ($args) {
  // there you can do some code
  
  // Code ...
  
  // in html builder you always should return Html class or class extended from Html class
  return (new HtmlDocument)
  ->SetTitle("Example page")
  ->SetLanguage("ru")
  ->SetBody(
    // there i use layout Html Column to group elements to column
    (new HtmlQueue)
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
})

Html::RunOf(/* there shoud be HtmlDocument */ $page, /* debug id on or not */ true)

?>

```
