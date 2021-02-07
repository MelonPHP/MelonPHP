<?php

require_once __DIR__ . '/../src/melon.php';

class Test1Display extends DisplayWidget {
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
                        color: Mea::hex('432298')
                    ),
                ),
            )
        );
    }
}

class Test2Display extends DisplayWidget {
    function build() : Scaffold {
        return new Scaffold(
            title: 'test 2 page',
            body: new Text('HORNY'),
        );
    }
}

class NotFindDisplay extends DisplayWidget {
    function build() : Scaffold {
        return new Scaffold(
            title: 'PAGE NOT FIND',
            body: new Text('PAGE NOT FIND'),
        );
    }
}

Route::add("/", function () { 
    return new Test1Display(); 
});

Route::add("/test", function () { 
    return new Test2Display(); 
});

Route::add("/not_find", function () { 
    return new NotFindDisplay(); 
});

Route::run("/", notFind: "/not_find");

