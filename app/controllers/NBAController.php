<?php

namespace app\controllers;

use app\core\Controller;
use app\models\NBA;

class NBAController extends Controller {

    // Fetch NBA Teams and return as JSON
    public function showTeams() {
        $cursor = isset($_GET['cursor']) ? $_GET['cursor'] : null;
        $nba = new NBA();
        $teams = $nba->getTeams($cursor);

        header('Content-Type: application/json');
        echo json_encode($teams);
    }

    // Fetch NBA Players and return as JSON
    public function showPlayers() {
        $cursor = isset($_GET['cursor']) ? $_GET['cursor'] : null;
        $nba = new NBA();
        $players = $nba->getPlayers($cursor);

        header('Content-Type: application/json');
        echo json_encode($players);
    }
}
