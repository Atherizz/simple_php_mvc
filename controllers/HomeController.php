<?php

require "core/auth.php";

class HomeController {
    public function index() {
        $middleware = new AuthMiddleware();
        $middleware->requireLogin();
        require 'views/home.php';
    }
}
