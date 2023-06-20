<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('login', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('unloggedMain', 'DefaultController');
Routing::get('main', 'DefaultController');
Routing::get('info', 'DefaultController');
Routing::get('bookCar', 'DefaultController');
Routing::get('addCar', 'DefaultController');
Routing::run($path);
