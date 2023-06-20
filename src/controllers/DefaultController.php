<?php

require_once 'AppController.php';

class DefaultController extends AppController {
    
    public function login() {
        $this->render('login');
    }

    public function register() {
        $this->render('register');
    }

    public function unloggedMain() {
        $this->render('unloggedMain');
    }

    public function main() {
        $this->render('main');
    }

    public function info() {
        $this->render('carInfo');
    }

    public function bookCar() {
        $this->render('bookCar');
    }
}