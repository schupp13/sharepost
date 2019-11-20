<?php
class Pages extends Controller{
  public function __construct(){
  }

  //index method is the default method 
  public function index(){
    $this->view('pages/index',['title' => 'Welcome',
    'price' => 4.99]);
  }

  public function about(){
    $this->view('pages/about');
  }
}