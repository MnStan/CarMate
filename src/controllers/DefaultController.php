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

    public function addCar() {
        $this->render('addCar');
    }


    public function statute()
    {
        $this->render('statute');
    }

    public function contact()
    {
        $this->render('contact');
    }

    public function privacyPolicy()
    {
        $this->render('privacyPolicy');
    }
}