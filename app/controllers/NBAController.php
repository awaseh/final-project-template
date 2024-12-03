<?php

namespace app\controllers;

use app\core\Controller;
use app\models\NBA;

class NBAController extends Controller {

    // Fetch NBA Teams and return as JSON
    public function showTeams() {
        $nba = new NBA();
        $teams = $nba->getTeams();

        header('Content-Type: application/json');
        echo json_encode($teams);
    }

    // Fetch NBA Players and return as JSON
    public function showPlayers() {
        $nba = new NBA();
        $players = $nba->getPlayers();

        header('Content-Type: application/json');
        echo json_encode($players);
    }
}
