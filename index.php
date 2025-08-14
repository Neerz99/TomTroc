<?php


require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/autoload.php';

$em = EntityManager::fromConfig();
App::setEntityManager($em);

// Initialize the router
$router = new Router();
$router->handleRequest();
