<?php

require_once __DIR__ . '/../../../src/melon.php';

class ErrorDisplay extends DisplayWidget {
    function build() : Scaffold {
        return new Scaffold(
            title: "error 404",
            body: new Padding(
                padding: Edges::all(Metrica::px(25)),
                child: new Container(
                    normal: new BoxTheme(
                        radius: Radius::all(Metrica::px(100)),
                        color: Color::hex('fcfcfc'),
                        shadows: new Shadows([
                            new Shadow(
                                radius: Metrica::px(4),
                                spread: Metrica::px(1)
                            ),
                            new Shadow(
                                radius: Metrica::px(10),
                                spread: Metrica::px(10),
                                color: Color::hex('22222220')
                            ),
                        ]),
                        border: Borders::symmetric(
                            horizontal: new Border(
                                width: Metrica::px(2),
                                color: Color::hex('349934')
                            ),
                        ),
                    ),
                    press: new BoxTheme(
                        color: Color::hex('999999'),
                    ),
                    child: new Padding(
                        padding: Edges::all(Metrica::px(25)),
                        child: new Column(
                            crossAxisAlign: CrossAxisAlign::Center,
                            mainAxisAlign: MainAxisAlign::Center,
                            children: [
                                new Text('ERROR 404',
                                    normal: new TextTheme(
                                        size: 28,
                                        weight: FontWeight::Bold,
                                        color: Color::hex('878787'),
                                    ),
                                    hover: new TextTheme(
                                        color: Color::hex('000'),
                                    ),
                                    press: new TextTheme(
                                        color: Color::hex('fff'),
                                    ),
                                ),
                                new Container(height: Metrica::px(25)),
                                new Text('Page don\'t find',
                                    normal: new TextTheme(
                                        size: 16,
                                        weight: FontWeight::Medium,
                                    ),
                                ),
                            ],
                        ),
                    ),
                ),
            ),
        );
    }
}