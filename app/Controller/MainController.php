<?php

App::uses('AppController','Controller');

class MainController extends AppController {

  function index(){
    if ($this->request->is('post')) {
      $this->redirect('/twitter/twitter/apirequest?' .
        'q=' . $_POST['search'] .'%20from%3A' . $_POST['handle'] . '&' .
        'count=' . $_POST['num_tweets'] . '&' .
        'result_type=recent'
      );
    }
  }
  
  function test() {
    $method = "GET";
    $url = 'https://api.twitter.com/1.1/search/tweets.json';
    $params = array('q' => 'baseball');
    
    $this->redirect('/twitter/twitter/apirequest?q=baseball&method=post&url=https://api.twitter.com/1.1/search/tweets.json');
  }

}