

<?php
include 'api/ClassController.php';
include 'api/SportController.php';
include 'api/WeatherController.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// echo get_pwd();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
$uri_len = count($uri);

$requestMethod = $_SERVER["REQUEST_METHOD"];
// pass the request method and user ID to the PersonController and process the HTTP request:

if ($uri[$uri_len - 2] === "sport") {
    $sportController = new \Api\SportController($requestMethod, $uri[$uri_len - 1]);
    $sportController->processRequest();
}

if ($uri[$uri_len - 2] === "class") {
    $classController = new \Api\ClassController($requestMethod, $uri[$uri_len - 1]);
    $classController->processRequest();
}



if ($uri[$uri_len - 2] === "weather") {
    $weatherController = new \Api\WeatherController($requestMethod, $uri[$uri_len - 1]);
    $weatherController->processRequest();
}

