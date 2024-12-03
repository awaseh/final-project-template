<?php

// Include the necessary core files for the app
require_once __DIR__ . '/Router.php';              // Router class for URL routing
require_once __DIR__ . '/../models/Model.php';     // Base Model class
require_once __DIR__ . '/../controllers/Controller.php';  // Corrected the path to Controller.php
require_once __DIR__ . '/../controllers/MainController.php';  // Main Controller class
require_once __DIR__ . '/../controllers/UserController.php';  // User Controller class
require_once __DIR__ . '/../controllers/NBAController.php';  // NBA Controller class
require_once __DIR__ . '/../models/User.php';      // User model class
require_once __DIR__ . '/../models/NBA.php';       // NBA model class


// Set up environment variables
$env = parse_ini_file('../.env');

define('DBNAME', $env['DBNAME']);
define('DBHOST', $env['DBHOST']);
define('DBUSER', $env['DBUSER']);
define('DBPASS', $env['DBPASS']);
define('DBDRIVER', 'mysql');  // Database driver
define('BALLDONTLIE_API_KEY', $env['BALLDONTLIE_API_KEY']);
// Set other configurations
define('DEBUG', true);




