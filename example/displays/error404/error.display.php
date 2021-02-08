<?php

require_once __DIR__ . '/../../../src/melon.php';

class ErrorDisplay extends DisplayWidget {
    function build() : Scaffold {
        return new Scaffold(
            title: "error 404",
            body: new Container(
                normal: new BoxTheme(
                    color: Color::hex('fcfcfc'),
                ),
                press: new BoxTheme(
                    color: Color::hex('999999'),
                ),
                child: new Column(
                    margin: Edges::all(Metrica::px(25)),
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
        );
    }
}