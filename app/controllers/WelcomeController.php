<?php
namespace Ti\Mss\App\controllers;



class WelcomeController extends Controller
{
	 public function index() {
         $this->view("welcome", "admin", 'footer', []);
	}
}