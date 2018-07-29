<?php
  class Pages extends Controller{

    public function __construct(){
     
    }

    public function index(){

      if(isLoggedIn()){
        redirect('posts');
      }

      $data = [
        'title' => 'Welcome',
        'description' => 'This is Awesome PostSharing Site'
      ];

      $this->view('pages/index',$data);
    }

    public function about(){
      $data = [
        'title' => 'About Us',
        'description' => 'App to share Post with other Users'
      ];

      $this->view('pages/about', $data);
    }
  }