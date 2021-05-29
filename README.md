# Melon PHP

> Simple HTML and CSS generator like flutter but for PHP

## Examples

### Controller

```php
class MainDisplayController extends Controller {
    public String|Null $name;

    function __construct() {
        $this->name = $this->getValue('name');
    }
}
```


### Display

```php
class MainDisplay extends DisplayWidget {
    private MainDisplayController $controller;

    function __construct() {
        $this->controller = new MainDisplayController();
    }

    function buildTitle() : Widget {
        return $this->controller->name === null 
            ? new Text('Put your name at get request. example: "http://localhost:8000/?name=Roman S"')
            : new Text('Hello, '.$this->controller->name,
                    normal: new TextTheme(
                        size: Metrica::px(20),
                        weight: FontWeight::Bold,
                    ),
                    hover: new TextTheme(
                        color: Color::hex("449922"),
                        weight: FontWeight::Medium
                    ),
                );
    }

    function build() : Scaffold {
        return new Scaffold(
            title: "hello",
            body: new Column(
                children: [
                    new Row(
                        mainAxisAlign: MainAxisAlign::Around,
                        crossAxisAlign: CrossAxisAlign::Center,
                        children: [
                            $this->buildTitle(),
                            $this->buildTitle(),
                        ]
                    ),
                    new Row(
                        mainAxisAlign: MainAxisAlign::Between,
                        crossAxisAlign: CrossAxisAlign::Center,
                        children: [
                            $this->buildTitle(),
                            $this->buildTitle(),
                        ]
                    ),
                ]
            )
        );
    }
}
```

###### result:

![](https://github.com/MelonPHP/MelonPHP/blob/stable/.assets/ex_3.png)

#

License: [GNU General Public License v3.0](LICENSE)

© 2020
