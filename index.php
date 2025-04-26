<?php


require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/autoload.php';

// Initialize the router
$router = new Router();
$router->handleRequest();
