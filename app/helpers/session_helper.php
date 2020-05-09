<?php 
    session_start();
    // Flash messages 
    // before redirting after register-success => flash('register_success','You're registered successfully!','OPTIONAL - CLASS')
    // in the template/view => echo flash('register_success');
    function flash($name='',$message='',$class='alert alert-success'){
        if(!empty($name)){
            // Storing the message + default class into session variable
            // When message is provided && $_SESSION['name'] variable is empty 
           if(!empty($message) && empty($_SESSION[$name])){
            
                $_SESSION[$name] = $message;
                $_SESSION[$name.'_class'] = $class;

           }else{
               // Displaying the stored message + unsetting the session vairables
               // When message is not provided && $_SESSION['name'] is not empty [already exists]
               if(empty($message) && !empty($_SESSION[$name])){
                    $class = $_SESSION[$name.'_class'];
                    echo "<div class='{$class}'> $_SESSION[$name] </div>";
                    unset($_SESSION[$name]);
                    unset($_SESSION[$name.'_class']);
                    unset($class);
               }
           }
        }
    }
?>