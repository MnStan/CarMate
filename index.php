<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$base = parse_url($path, PHP_URL_PATH);
$query = parse_url($path, PHP_URL_QUERY);

Routing::get('', 'CarController');
Routing::get('carInfo', 'CarController');
Routing::get('addCar', 'CarController');
Routing::post('addCarForm', 'CarController');
Routing::get('main', 'CarController');
Routing::post('searchCars', 'CarController');


Routing::get('unloggedMain', 'DefaultController');
Routing::get('login', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('statute', 'DefaultController');
Routing::get('contact', 'DefaultController');
Routing::get('privacyPolicy', 'DefaultController');

Routing::post('checkLogin', 'SecurityController');
Routing::post('checkRegister', 'SecurityController');

Routing::post('logout', 'SessionController');

Routing::run($base, $query);