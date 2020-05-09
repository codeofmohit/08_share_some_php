<?php 
    # App core class
    # Create URL & loads Core controller
    # URL format -> /controller/method/params

    class Core {
        protected $currentController = 'Pages'; // default controller to load
        protected $currentMethod = 'index'; // default method to load
        protected $params = [];

        public function __construct(){
            
            $url = $this->getUrl();

            // Checks for the controller as first array index, if exisits then replace the default (Pages)
            if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
                $this->currentController = ucwords($url[0]);
                // unset the index of array [so that it can hold param as an only value]
                unset($url[0]);
            }

            // Require the current controller
            require_once '../app/controllers/'.$this->currentController.'.php';

            // Instantiating the current controller
            $this->currentController = new $this->currentController;

            // Check for methods as 2nd array index, if exists then replace default (index)
            if(isset($url[1])){
                if(method_exists($this->currentController,$url[1])){
                    $this->currentMethod = $url[1];
                    // unset the index of array [so that it can hold param as an only value]
                    unset($url[1]);
                }
            }

            // Getting params
            //$this->params = $url ? $url : [] ; // CAN NOT USE THIS AS IT WILL RETURN THE KEY ALSO [which is 2nd index]
            $this->params = $url ? array_values($url) : [] ;
            //echo print_r(array_values($url));
            //echo print_r($url);
            

            // Callin the function
            call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
            // Do not confuse basically we're calling the current method of controller class in the first param and in the 2nd param we are passing the param array as an argument
            // call_user_func_array(arra    y($classInstance, $methodName), array($arg1, $arg2, $arg3));

        }

        // getUrl() -- for taking the url parameters [value store in $url varibale in query string (via .htaccess file)]
        public function getUrl(){
            if(isset($_REQUEST['url'])){
                $url = $_REQUEST['url'];
                $url = rtrim($url,'/');
                $url = filter_var($url,FILTER_SANITIZE_URL);
                $url = explode('/',$url);
                return $url;
            }
        }
    }
?>