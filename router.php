<?php

use MyApp\controllers\StudentController;
use MyApp\repositories\StudentRepository;
use MyApp\services\StudentService;

session_start();

/**
 * @param $route
 */
function get($route)
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        route($route);
    }
}

function any($route)
{
    route($route);
}

/**
 * Routes to adequate controller
 *
 * @param $route
 */
function route($route)
{
    $root = $_SERVER['DOCUMENT_ROOT'];
    if ($route == "/404") {
        include_once("$root/'path to 404 not found page'");
        exit();
    }

    $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
    $request_url = rtrim($request_url, '/');
    $request_url = strtok($request_url, '?');
    $route_parts = explode('/', $route);
    $requestUrlParts = explode('/', $request_url);
    array_shift($route_parts);
    array_shift($requestUrlParts);

    if (count($route_parts) != count($requestUrlParts)) {
        return;
    }

    if ($route === $request_url) {
        switch ($requestUrlParts[0]) {
            case '':
                call_user_func([new StudentController(new StudentService(new StudentRepository())), 'index']);
                break;
        }
    }
}

function out($text)
{
    echo htmlspecialchars($text);
}