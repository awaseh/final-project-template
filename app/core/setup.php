<?php


require_once __DIR__ . '/../../config.php';  // config

// Include the necessary core files for the app
require_once __DIR__ . '/Router.php';              // Router class for URL routing
require_once __DIR__ . '/../models/Model.php';     // Base Model class
require_once __DIR__ . '/../controllers/Controller.php';  // Base Controller class
require_once __DIR__ . '/../controllers/MainController.php';  // Main Controller class
require_once __DIR__ . '/../controllers/UserController.php';  // User Controller class
require_once __DIR__ . '/../controllers/NBAController.php';  // Add NBA Controller class
require_once __DIR__ . '/../models/User.php';      // User model class
require_once __DIR__ . '/../models/NBA.php';       // Add NBA model class


define('DBDRIVER', 'mysql');  // Database driver (mysql in this case)

// Set other configurations
define('DEBUG', true);


if (!isset($_ENV['BALLDONTLIE_API_KEY'])) {
    loadEnv();
}

