<?php

require_once __DIR__ . '/../../../src/melon.php';

class ErrorDisplay extends DisplayWidget {
    function build() : Scaffold {
        return new Scaffold(
            title: "error 404",
            body: new Text('Page not found'),
        );
    }
}