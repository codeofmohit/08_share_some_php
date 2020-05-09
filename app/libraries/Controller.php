<?php 
    # Base Controller class
    # Load models and views from other controllers
    # All the controllers would be extending this Controller class

    class Controller{
        // Load model
        public function model($model){
            if(file_exists('../app/models/'.$model.'.php')){
                // if file exists then require it
                require_once '../app/models/'.$model.'.php';
                // then instatitae & return
                return new $model;
            }
        }
        // Load view
        public function view($view, $data=[]){
            if(file_exists('../app/views/'.$view.'.php')){
                // if file exists then require it
                require_once '../app/views/'.$view.'.php';
            }else{
                // stop the applciation if view does not exist
                die("view does not exist");
            }
        }
    }
?>