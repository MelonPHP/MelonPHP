<?php

require_once __DIR__ . '/../../../src/melon.php';

class ErrorDisplay extends DisplayWidget {
    function build() : Scaffold {
        return new Scaffold(
            title: "error 404",
            body: new Padding(
                padding: Edges::all(Metrica::px(25)),
                child: new VerticalScrollBar(
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
                                    new Container(height: Metrica::px(25)),
                                    new Image('https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fpre00.deviantart.net%2F1d2b%2Fth%2Fpre%2Ff%2F2016%2F198%2F2%2F8%2F__render__neko_felix_argyle_by_xbunnygoth-daaedf6.png&f=1&nofb=1',
                                        width: Metrica::px(300),
                                        height: Metrica::px(500),
                                        radius: Radius::all(Metrica::pr(2)),
                                    ),
                                ],
                            ),
                        ),
                    ),
                ),
            ),
        );
    }
}