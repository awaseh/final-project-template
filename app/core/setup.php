<?php

// Load environment variables from the .env file
require_once __DIR__ . '/../../config.php';  // config

// Include the necessary core files for the app
require_once __DIR__ . '/Router.php';              // Router class for URL routing
require_once __DIR__ . '/../models/Model.php';     // Base Model class
require_once __DIR__ . '/../controllers/Controller.php';  // Base Controller class
require_once __DIR__ . '/../controllers/MainController.php';  // Main Controller class
require_once __DIR__ . '/../controllers/UserController.php';  // User Controller class
require_once __DIR__ . '/../models/User.php';      // User model class

// Define other constants for your app
define('DBDRIVER', 'mysql');  // Database driver (mysql in your case)

// Set other configurations
define('DEBUG', true);
