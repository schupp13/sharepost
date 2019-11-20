<?php
/**
 * Base controller - this loads the models and views
 */
 class Controller {
   // Load model
   public function model($model){
    //require model file
    require_once '../app/models/' . $model . '.php';
    //Instantiate model
    return new $model();
   }

   // Load view
   public function view ($view, $data=[]){
     // check for view file, if it exist require it
      if(file_exists('../app/views/' . $view . '.php')){
        require_once '../app/views/' . $view . '.php';
      }else{
        //view does not exist
        die('View does not exist');
      }

   }
 }