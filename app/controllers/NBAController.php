<?php

namespace app\controllers;

use app\models\NBA;

class NBAController extends Controller {

    // Method to fetch NBA teams
    public function showTeams() {
        $nba = new NBA();
        $teams = $nba->getTeams(); // Fetch NBA teams

        if (empty($teams)) {
            $this->returnJSON(['message' => 'No teams available']); // If no data, return a message
        } else {
            $this->returnJSON($teams); // Return teams data as JSON
        }
    }

    // Method to fetch NBA players
    public function showPlayers() {
        $nba = new NBA();
        $players = $nba->getPlayers(); // Fetch NBA players

        if (empty($players)) {
            $this->returnJSON(['message' => 'No players available']); // If no data, return a message
        } else {
            $this->returnJSON($players); // Return players data as JSON
        }
    }
}

