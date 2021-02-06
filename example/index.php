<?php

require_once __DIR__ . '/../src/melon.php';

class TestDisplay extends DisplayWidget {
    function build() : Scaffold {
        return new Scaffold(
            title: 'test page',
            body: new Padding(
                padding: PaddingEdges::all(Mea::Px(100)),
                child: new Text('Title', 
                    theme: new TextTheme(
                        fontSize: Mea::Px(24)
                    ),
                    hoverTheme: new TextTheme(
                        fontSize: Mea::Px(13)
                    ),
                ),
            )
        );
    }
}

$view = new TestDisplay();
$view->display();

