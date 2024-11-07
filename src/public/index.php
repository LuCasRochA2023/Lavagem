<?php
require_once "../config/db.php";
require_once "../controllers/UserController.php";
require_once "../routes/Router.php";

header("Content-type: application/json; charset=UTF-8");


$router = new Router();

$controller = new UserController($pdo);


$router->add('POST', '/users', [$controller, 'create']);

$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$pathItems = explode("/", $requestedPath);
$requestedPath = "/" . $pathItems[1];  

$router->dispatch($requestedPath);
?>
