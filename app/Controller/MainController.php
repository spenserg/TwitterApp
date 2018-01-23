<?php

App::uses('AppController','Controller');

class MainController extends AppController {

  function index(){
    $handle = "";
    $location = "";
    $search_term = "";
    if ($this->request->is('post')) {
      $handle = $_POST['handle'];
      $location = $_POST['location'];
      $search_term = $_POST['search_term'];
    }
    $this->set('handle', $handle);
    $this->set('location', $location);
    $this->set('search_term', $search_term);
  }

}