<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/../app/core/setup.php';  
use app\core\Router;

$router = new Router();
