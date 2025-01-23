<?php

    define('APP', 'http://localhost/gitexplorelk/explorelk/app');
    define('ROOT', 'http://localhost/gitexplorelk/explorelk/public');
    define('CSS', 'http://localhost/gitexplorelk/explorelk/public/assets/css');
    define('IMAGES', 'http://localhost/gitexplorelk/explorelk/public/assets/images');
    // define('CSS', 'http://localhost/gitexplorelk/explorelk/public/assets/css');
    // define('IMAGES', 'http://localhost/gitexplorelk/explorelk/public/assets/images');
    define('APPROOT',dirname(dirname(__FILE__)));

    //My name is sharma

    if($_SERVER['SERVER_NAME'] == 'localhost'){

        /** database config **/
        define('DBHOST', 'localhost');
        define('DBNAME', 'explorelk_test');
        define('DBUSER', 'root');
        define('DBPASS', '');
    }
    else{
        define('ROOT', 'https://www.explorelk.com');
    }
    
    
    