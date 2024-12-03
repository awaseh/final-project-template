<?php

namespace app\core;

class Controller {
 
    protected function render($view, $data = []) {
        extract($data);
        require_once __DIR__ . "/../../public/views/{$view}.php";
    }
}
