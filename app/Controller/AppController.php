<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
  
  public $components = array('Auth'=>array(),'Session');
  
  // Called right before EVERY action for every controller
  public function beforeFilter(){
    $this->Auth->allow(); // Pages by default do NOT require login
  
    Configure::write("client_ip", $this->request->clientIp(false));
  
    if($this->request->is('ajax') || $this->request->query('json')){
      $this->json();
    }
  }
  
  // This is called right after EVERY action for every controller
  public function afterFilter(){}
  
  public function beforeRedirect($url, $status = null, $exit = true){
    // Prevent redirect if an error has occurred that we might miss!
    if(Configure::read('App.error_occurred') && Configure::read('debug')){
      die('Redirect prevented due to error!');
    }
    return array(compact('url', 'status', 'exit'));
  }
  
  public function beforeRender(){
    if(count($this->viewVars) == 1 && isset($this->viewVars['json']))
      $this->json();
  
    // Set some global variables available to all Views
    $logged_in = $this->Auth->loggedIn();
  
    $this->set('is_logged_in', $logged_in);
    $this->set('current_user', $logged_in? $this->Auth->user() : null);
  
    $this->set('base_path',  FULL_BASE_URL . '/');
    $this->set('base_path_secure',    str_ireplace('http:', 'https:', FULL_BASE_URL) . '/');
    $this->set('base_path_insecure',  str_ireplace('https:', 'http:', FULL_BASE_URL) . '/');
    $this->set('is_ssl', stripos(FULL_BASE_URL, 'http://') === false);
  }
  
  protected function logged_in(){
    return $this->Auth->loggedIn();
  }
  
  protected function login_redirect_url($url = null){
    return strlen($url)? $this->Auth->redirectUrl($url): $this->Auth->redirectUrl();  // should never be used statically
  }
  
  protected function requireSSL(){
    if(stripos(FULL_BASE_URL, 'https://') === false)
      $this->redirect(str_ireplace('http:', 'https:', FULL_BASE_URL) . $_SERVER[ 'REQUEST_URI' ]);
  }
  
  // alert  -- setFlash() wrapper
  protected function alert($msg, $config = null){
    $type = 'success';
    if(!$config){}
    elseif($config == 'err' || $config == 'error' || $config == 'e' || $config == 'bad')
    $type = 'danger';
    elseif($config == 'info' || $config == 'i')
    $type = 'info';
  
    if(strlen($msg))
      $this->Session->setFlash(__($msg), 'alert_msg', array('class' => 'alert alert-' . $type));
    else
      $this->Session->delete('Message.flash');
  }
  
  // Output JSON instead of normal page with headers and footers
  protected function json(){
    $this->layout = 'ajax';
    $_SERVER['HTTP_X_REQUESTED_WITH'] = 'xmlhttprequest';
    $this->view = '/Elements/json';
    $this->response->type('json');
  }
  
  // Output an error message as JSON
  protected function json_error($str){
    $this->json();
  
    $this->set('json', array('error_msg' => $str));
    return false;
  }
  
  // Auto Loader for Models
  public function &__get($name) {
    if(!isset($this->modelsList))
      $this->modelsList = array_flip(App::objects('model'));
  
    if(isset($this->modelsList[$name])){
      try {
        $this->loadModel($name);
        return $this->$name;
      } catch(Exception $e) { }
    }
  
    // Model not found. Let's see if our parent knows what we're trying to access
    $ret = parent::__get($name);
    return $ret; // must return a variable containing false/null, not false itself
  }
}
