<?php

require_once __DIR__ . '/../../../src/melon.php';

class ErrorDisplay extends DisplayWidget {
    function build() : Scaffold {
        return new Scaffold(
            title: "error 404",
            body: new Container(
                theme: new BoxTheme(
                    backgroundColor: Color::hex('fcfcfc'),
                ),
                pressTheme: new BoxTheme(
                    backgroundColor: Color::hex('999999'),
                ),
                child: new Column(
                    margin: Edges::all(Metrica::px(25)),
                    crossAxisAlign: CrossAxisAlign::Center,
                    mainAxisAlign: CrossAxisAlign::Center,
                    children: [
                        new Text('ERROR 404',
                            theme: new TextTheme(
                                fontSize: 28,
                                fontWeight: FontWeight::Bold,
                                color: Color::hex('878787'),
                            ),
                        ),
                        new Container(height: Metrica::px(25)),
                        new Text('Page don\'t find',
                            theme: new TextTheme(
                                fontSize: 16,
                                fontWeight: FontWeight::Medium,
                            ),
                        ),
                    ],
                ),
            ),
        );
    }
}