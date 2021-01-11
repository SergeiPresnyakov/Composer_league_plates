<?php
require '../vendor/autoload.php';

$defaultViewController = 'Components\ViewController';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', ['Components\ViewController', 'users']);
    $r->addRoute('GET', '/create', ['Components\ViewController', 'create_user']);
    $r->addRoute('POST', '/create/newuser', ['Components\ViewController', 'create_user_handler']);
    $r->addRoute('GET', '/edit/{id:\d+}', ['Components\ViewController', 'edit_user']);
    $r->addRoute('POST', '/edit/user', ['Components\ViewController', 'edit_user_handler']);
    $r->addRoute('GET', '/about', ['Components\ViewController', 'about']);
    $r->addRoute('GET', '/delete/{id:\d+}', ['Components\ViewController', 'delete_user']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        $controller = new $defaultViewController;
        call_user_func([$controller, 'error404']);
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        $controller = new $defaultViewController;
        call_user_func([$controller, 'error405']);
        break;

    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $controller = new $handler[0];
        // ... call $handler with $vars
        call_user_func([$controller, $handler[1]], $vars);
        break;
}