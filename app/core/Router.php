<?php

namespace app\core;

use app\controllers\MainController;
use app\controllers\UserController;

class Router {
    public $urlArray;

    function __construct() {
        $this->urlArray = $this->routeSplit();
        $this->handleMainRoutes();
        $this->handleUserRoutes();
    }

    protected function routeSplit() {
        $removeQueryParams = strtok($_SERVER["REQUEST_URI"], '?');
        return explode("/", $removeQueryParams);
    }

    protected function handleMainRoutes() {
        if ($this->urlArray[1] === '' && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $mainController = new MainController();
            $mainController->homepage();
        }
    }

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
}
