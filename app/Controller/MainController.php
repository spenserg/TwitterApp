<?php

App::uses('AppController','Controller');
App::import('Vendor', 'OAuth/OAuthClient');

class MainController extends AppController {

  function index(){
    if ($this->request->is('post')) {
      
    }
  }
  
  public function test() {
        $client = $this->createClient();
        $requestToken = $client->getRequestToken('https://api.twitter.com/oauth/request_token', 'http://' . $_SERVER['HTTP_HOST'] . '/example/callback');

        if ($requestToken) {
            $this->Session->write('twitter_request_token', $requestToken);
            $this->redirect('https://api.twitter.com/oauth/authorize?oauth_token=' . $requestToken->key);
        } else {
            // an error occured when obtaining a request token
        }
        
        $x = get_tweets('https://api.twitter.com/1.1/search/tweets.json?q=baseball');
        debug($x);
        
    }

    public function callback() {
        $requestToken = $this->Session->read('twitter_request_token');
        $client = $this->createClient();
        $accessToken = $client->getAccessToken('https://api.twitter.com/oauth/access_token', $requestToken);

        if ($accessToken) {
            $client->post($accessToken->key, $accessToken->secret, 'https://api.twitter.com/1/statuses/update.json', array('status' => 'hello world!'));
        }
    }

    private function createClient() {
        return new OAuthClient(Configure::read('Twitter.key'), Configure::write('Twitter.secret'));
    }
   
}