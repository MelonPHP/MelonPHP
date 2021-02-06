<?php

require_once __DIR__ . '/../src/melon.php';

class TestDisplay extends DisplayWidget {
    function build() : Scaffold {
        return new Scaffold(
            title: 'test page',
            body: new Padding(
                padding: PaddingValue::all(Css::Px(100)),
                child: new Text('Title', theme: new TextTheme(fontSize: Css::Px(19)))
            )
        );
    }
}