<?php

require_once __DIR__ . '/../../../src/melon.php';

class ErrorDisplay extends DisplayWidget {
    function build() : Scaffold {
        return new Scaffold(
            title: "error 404",
            body: new Container(
                theme: new ContainerTheme(
                    backgroundColor: Mea::hex('fcfcfc'),
                ),
                pressTheme: new ContainerTheme(
                    backgroundColor: Mea::hex('999999'),
                ),
                child: new Column(
                    margin: PaddingEdges::all(Mea::px(25)),
                    crossAxisAlign: CrossAxisAlign::Center,
                    mainAxisAlign: CrossAxisAlign::Center,
                    children: [
                        new Text('ERROR 404',
                            theme: new TextTheme(
                                fontSize: 28,
                                fontWeight: FontWeight:: Bold,
                                color: Mea::hex('878787'),
                            ),
                        ),
                        new Container(height: Mea::px(25)),
                        new Text('Page don\'t find',
                            theme: new TextTheme(
                                fontSize: 16,
                                fontWeight: FontWeight::Medium,
                            ),
                        ),
                        new Text('ERROR 404',
                            theme: new TextTheme(
                                fontSize: 28,
                                fontWeight: FontWeight:: Bold,
                                color: Mea::hex('878787'),
                            ),
                        ),
                        new Container(height: Mea::px(25)),
                        new Text('Page don\'t find',
                            theme: new TextTheme(
                                fontSize: 16,
                                fontWeight: FontWeight::Medium,
                            ),
                        ),
                        new Text('ERROR 404',
                            theme: new TextTheme(
                                fontSize: 28,
                                fontWeight: FontWeight:: Bold,
                                color: Mea::hex('878787'),
                            ),
                        ),
                        new Container(height: Mea::px(25)),
                        new Text('Page don\'t find',
                            theme: new TextTheme(
                                fontSize: 16,
                                fontWeight: FontWeight::Medium,
                            ),
                        ),
                        new Text('ERROR 404',
                            theme: new TextTheme(
                                fontSize: 28,
                                fontWeight: FontWeight:: Bold,
                                color: Mea::hex('878787'),
                            ),
                        ),
                        new Container(height: Mea::px(25)),
                        new Text('Page don\'t find',
                            theme: new TextTheme(
                                fontSize: 16,
                                fontWeight: FontWeight::Medium,
                            ),
                        ),
                        new Text('ERROR 404',
                            theme: new TextTheme(
                                fontSize: 28,
                                fontWeight: FontWeight:: Bold,
                                color: Mea::hex('878787'),
                            ),
                        ),
                        new Container(height: Mea::px(25)),
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