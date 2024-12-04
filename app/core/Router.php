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
        $this->handleViewRoutes(); // Handle NBA view routes (playersView, teamsView)
    }

    // Split the URL into an array for easy parsing
    protected function routeSplit() {
        $removeQueryParams = strtok($_SERVER["REQUEST_URI"], '?');
        return explode("/", $removeQueryParams);
    }

    // Handle the main route (homepage)
    protected function handleMainRoutes() {
        if ($this->urlArray[1] === '' && $_SERVER['REQUEST_METHOD'] === 'GET') {
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

            if ($this->urlArray[3] === 'teams' && $_SERVER['REQUEST_METHOD'] === 'GET') {
                $nbaController->showTeams();
            }

            if ($this->urlArray[3] === 'players' && $_SERVER['REQUEST_METHOD'] === 'GET') {
                $nbaController->showPlayers();
            }
        }
    }

    // Handle NBA View Routes (playersView, teamsView)
    protected function handleViewRoutes() {
        // Route for players view
        if ($this->urlArray[1] === 'views' && $this->urlArray[2] === 'nba' && $this->urlArray[3] === 'playersView.html') {
            // Include the players view HTML
            $filePath = __DIR__ . '/../../public/assets/views/nba/playersView.html';
            if (file_exists($filePath)) {
                readfile($filePath);
            } else {
                echo "Error: playersView.html not found.";
            }
            exit();
        }

        // Route for teams view
        if ($this->urlArray[1] === 'views' && $this->urlArray[2] === 'nba' && $this->urlArray[3] === 'teamsView.html') {
            // Include the teams view HTML
            $filePath = __DIR__ . '/../../public/assets/views/nba/teamsView.html';
            if (file_exists($filePath)) {
                readfile($filePath);
            } else {
                echo "Error: teamsView.html not found.";
            }
            exit();
        }
    }
}




