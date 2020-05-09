<?php 

    // Loading Config file
    require_once 'config/config.php';

    // Loading helpers
    require_once 'helpers/url_redirect.php';

    // loading flash msgs helper
    require_once 'helpers/session_helper.php';

    // Loading Libraries
    // require_once 'libraries/Core.php';
    // require_once 'libraries/Controller.php';
    // require_once 'libraries/Database.php';

    // Autoload All Libraries - its a loop function - [rule - library name and class name must be same]
    spl_autoload_register(function($className){
        require_once 'libraries/'. $className .'.php';
    });
    
?>