<?php
/**
 * App Core Class
 * Creates URL & Loads core controller
 * URL FORMAT - /controller/method/params
 */

 class Core{
   protected $currentController = 'Pages';
   protected $currentMethod = 'index';
   protected $params = [];

   public function __construct(){ 
    $url = $this->getUrl();

    // Look in controllers for first value
    if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
      // If exists, set as controller
      $this->currentController = ucwords($url[0]);
      //Unset 0 Index
      unset($url[0]);
      
     }
     //Require the controller 
     require_once '../app/controllers/' . $this->currentController . '.php';
     // Instantiate contrller class (this is like saying $pages = new Pages)
     $this->currentController = new $this->currentController;
     
     // Check for second part of url (array) AKA the methods
     if(isset($url[1])){
       //Check to see if method exists in controller 
       if(method_exists($this->currentController, $url[1])){
         $this->currentMethod = $url[1];
        //unset 1 index
          unset($url[1]);
       }
      }

     

      // Get params
      $this->params = $url ? array_values($url) : [];

      // Call a callback with array of params
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params );
   }

   public function getUrl(){
     if(isset($_GET['url'])){
      //  below gets rid of the ending slash (if there is one)
      $url = rtrim($_GET['url'], '/');
      // below sanitized the URL 
      $url = filter_var($url, FILTER_SANITIZE_URL);
      // below breakes the url values into an array
      $url = explode('/', $url);
      return $url;
     }
   }

 }