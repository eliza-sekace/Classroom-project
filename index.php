<?php
require_once 'vendor/autoload.php';

use App\Redirect;
use App\Repositories\Products\PdoProductRepository;
use App\Views\View;

require_once 'vendor/autoload.php';
session_start();

$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    PdoProductRepository::class=>DI\create(PdoProductRepository::class)
]);
$container=$builder->build();


$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {

    $r->addRoute('GET', '/products', ['App\Controllers\ProductsController', 'index']);
    $r->addRoute('GET', '/products/create', ['App\Controllers\ProductsController', 'create']);
    $r->addRoute('POST', '/products', ['App\Controllers\ProductsController', 'store']);
    $r->addRoute('GET', '/products/{id}', ['App\Controllers\ProductsController', 'show']);

    $r->addRoute('GET', '/cart', ['App\Controllers\CartController', 'show']);

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
        var_dump('404 Not Found');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $vars = $routeInfo[2] ?? [];

        $view = (new $handler)->$method($vars);

        $loader = new \Twig\Loader\FilesystemLoader('app/views');
        $twig = new \Twig\Environment($loader);

        if ($view instanceof View) {
            echo $twig->render($view->getPath(), $view->getVariables());
        }

        if ($view instanceof Redirect) {
            header('Location: ' . $view->getLocation());
            exit;
        }

        break;
}

if (isset($_SESSION['errors'])) {
    unset($_SESSION['errors']);
}

if (isset($_SESSION['inputs'])) {
    unset($_SESSION['inputs']);
}