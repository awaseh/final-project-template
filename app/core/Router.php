<?php

namespace app\core;

use app\controllers\MainController;
use app\controllers\UserController;
use app\controllers\NBAController;

class Router {

    public $urlArray;

    function __construct() {
        $this->urlArray = $this->routeSplit();
        $this->handleMainRoutes(); // Handle the homepage route
        $this->handleUserRoutes(); // Handle user-related API routes
        $this->handleNBARoutes();  // Handle NBA API routes (teams and players)
    }

    // Split the URL into an array for easy parsing
    protected function routeSplit() {
        // Get the request URL and remove any query parameters
        $removeQueryParams = strtok($_SERVER["REQUEST_URI"], '?');
        // Split the URL into parts by '/'
        return explode("/", $removeQueryParams);
    }

    // Handle the main route (homepage)
    protected function handleMainRoutes() {
        if ($this->urlArray[1] === '' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            // Instantiate MainController and call the homepage method
            $mainController = new MainController();
            $mainController->homepage();
        }
    }

    // Handle user-related routes (GET, POST, DELETE)
    protected function handleUserRoutes() {
        if ($this->urlArray[1] === 'api' && $this->urlArray[2] === 'users') {
            $userController = new UserController();

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $userController->getUsers();
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $userController->saveUser();
            } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                $userController->deleteUser();
            }
        }
    }

    // Handle NBA-related routes (teams and players)
    protected function handleNBARoutes() {
        if ($this->urlArray[1] === 'api' && $this->urlArray[2] === 'nba') {

            $nbaController = new NBAController();

            // Route for teams
            if ($this->urlArray[3] === 'teams' && $_SERVER['REQUEST_METHOD'] === 'GET') {
                $nbaController->showTeams(); // Show teams
            }

            // Route for players
            if ($this->urlArray[3] === 'players' && $_SERVER['REQUEST_METHOD'] === 'GET') {
                $nbaController->showPlayers(); // Show players
            }
        }
    }
}


