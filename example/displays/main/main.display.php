<?php

require_once __DIR__ . '/../../../src/melon.php';
require_once __DIR__ . '/main.controller.php';

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