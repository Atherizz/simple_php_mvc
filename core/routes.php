<?php 
// routes.php
return [
    'GET' => [
        '/' => ['controller' => 'HomeController', 'action' => 'index'],
        '/home' => ['controller' => 'HomeController', 'action' => 'index'],
        '/about' => ['controller' => 'AboutController', 'action' => 'index'],
        '/login' => ['controller' => 'AuthController', 'action' => 'login_view'],
        '/register' => ['controller' => 'AuthController', 'action' => 'register_view'],
    ],
    'POST' => [
        '/login' => ['controller' => 'AuthController', 'action' => 'login_post'],
        '/register' => ['controller' => 'AuthController', 'action' => 'register_post'],
        '/logout' => ['controller' => 'AuthController', 'action' => 'logout'],
    ],
];

?>