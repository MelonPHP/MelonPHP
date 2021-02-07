<?php

require_once __DIR__ . '/../src/melon.php';
require_once __DIR__ . '/displays/error404/error.display.php';
require_once __DIR__ . '/displays/main/main.display.php';

Route::add("/", function () { 
    return new MainDisplay(); 
});

Route::add("/error404", function () { 
    return new ErrorDisplay(); 
});

Route::run(
    init: "/", 
    notFind: "/error404"
);

