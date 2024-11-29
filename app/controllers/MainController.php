<?php

namespace app\controllers;

class MainController {

    public function homepage() {
        // Correct relative path to homepage.html
        $filePath = __DIR__ . '/../../public/assets/views/main/homepage.html';
        if (file_exists($filePath)) {
            readfile($filePath);
        } else {
            echo "Error: File not found at $filePath";
        }
        exit();
    }
}
