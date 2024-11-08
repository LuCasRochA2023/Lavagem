<?php
require_once "../config/db.php";
require_once "../controllers/UserController.php";
require_once "../routes/Router.php";
require_once "../controllers/ServiceController.php";
header("Content-type: application/json; charset=UTF-8");

$router = new Router();
$controller = new UserController($pdo);
$serviceController = new ServiceController($pdo);
$router->add('GET', '/users', [$controller, 'list']);
$router->add('GET', '/users/{id}', [$controller, 'getById']);
$router->add('POST', '/users', [$controller, 'create']);
$router->add('DELETE', '/users/{id}', [$controller, 'delete']);
$router->add('PUT', '/services/{id}', [$serviceController, 'update']);
$router->add('GET', '/services', [$serviceController, 'list']);
$router->add('GET', '/services/{id}', [$serviceController, 'getById']);
$router->add('POST', '/services', [$serviceController, 'create']);
$router->add('DELETE','/services/{id}', [$serviceController, 'delete']);
$router->add('PUT', '/services/{id}', [$serviceController, 'update']);

$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$pathItems = explode("/", $requestedPath);
$requestedPath = implode("/", $pathItems);;
$router->dispatch(requestedPath: $requestedPath);
