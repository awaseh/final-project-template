<?php

// Correct file paths relative to setup.php
require __DIR__ . '/Router.php';
require __DIR__ . '/../models/Model.php';
require __DIR__ . '/../controllers/Controller.php';
require __DIR__ . '/../controllers/MainController.php';
require __DIR__ . '/../controllers/UserController.php';
require __DIR__ . '/../models/User.php';

// Load environment variables
$env = parse_ini_file(__DIR__ . '/../../.env');

define('DBNAME', $env['DBNAME']);
define('DBHOST', $env['DBHOST']);
define('DBUSER', $env['DBUSER']);
define('DBPASS', $env['DBPASS']);
define('DBDRIVER', 'mysql');

// Set other configurations
define('DEBUG', true);
