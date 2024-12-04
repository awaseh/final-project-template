<?php

namespace app\models;

class NBA {
    private $apiUrlTeams = "https://api.balldontlie.io/v1/teams"; // API endpoint for teams
    private $apiUrlPlayers = "https://api.balldontlie.io/v1/players"; // API endpoint for players
    private $apiKey; // Store the API key for authentication

    public function __construct() {
        // Set the API key for authentication (this is defined in the config/setup.php or .env)
        $this->apiKey = BALLDONTLIE_API_KEY; // Use the constant from setup.php
    }

    // Fetch NBA teams with pagination
    public function getTeams($cursor = null) {
        $url = $this->apiUrlTeams;
        if ($cursor) {
            $url .= '?cursor=' . $cursor; // Append cursor for pagination
        }

        // Send the cURL request and get the response
        $response = $this->makeRequest($url);

        // Check if response is valid, return the teams data
        if ($response) {
            $data = json_decode($response, true);
            if (isset($data['data'])) {
                return $data; // Return teams data with pagination metadata
            }
        }

        return []; // Return an empty array if the request fails or if no 'data' found
    }

    // Fetch NBA players with pagination
    public function getPlayers($cursor = null) {
        $url = $this->apiUrlPlayers;
        if ($cursor) {
            $url .= '?cursor=' . $cursor; // Append cursor for pagination
        }

        // Send the cURL request and get the response
        $response = $this->makeRequest($url);

        // Check if response is valid, return the players data
        if ($response) {
            $data = json_decode($response, true);
            if (isset($data['data'])) {
                return $data; // Return players data with pagination metadata
            }
        }

        return []; // Return an empty array if the request fails or if no 'data' found
    }

    // Function to make the cURL request to the API
    private function makeRequest($url) {
        $curl = curl_init(); // Initialize cURL session

        // Set cURL options
        curl_setopt_array($curl, [
            CURLOPT_URL => $url, // API endpoint URL
            CURLOPT_RETURNTRANSFER => true, // Return the response as a string
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET", // Use GET request
            CURLOPT_HTTPHEADER => [
                "Authorization: " . $this->apiKey // Use the API key directly in the header
            ],
        ]);

        // Execute the request and get the response
        $response = curl_exec($curl);

        // Check for any errors in the cURL request
        $err = curl_error($curl);

        curl_close($curl); // Close the cURL session

        // If there was an error with the request, log it and return null
        if ($err) {
            error_log("cURL Error #:" . $err); // Log the error
            return null;
        }

        return $response; // Return the API response
    }
}

