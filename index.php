<?php
session_start();

$routes = require 'core/routes.php';

define('BASE_PATH', dirname(__FILE__));

spl_autoload_register(function ($class) {
    $controllerFile = BASE_PATH . '/controllers/' . $class . '.php';
    if (file_exists($controllerFile)) {
        require $controllerFile;
        return;
    }
    
    $modelFile = BASE_PATH . '/models/' . $class . '.php';
    if (file_exists($modelFile)) {
        require $modelFile;
        return;
    }
});

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = $request_uri ?: '/';
$method = $_SERVER['REQUEST_METHOD'];

if (isset($routes[$method][$path])) {
    $controllerName = $routes[$method][$path]['controller'];
    $action = $routes[$method][$path]['action'];
    
    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            echo "Action not found!";
        }
    } else {
        echo "Controller not found!";
    }
} else {
    echo "404 - Page not found!";
}