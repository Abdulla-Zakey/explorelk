<?php

    define('APP', 'http://localhost/explorelkwithmvc/app');
    define('ROOT', 'http://localhost/gitexplorelk/explorelk/public');
    define('CSS', 'http://localhost/gitexplorelk/explorelk/public/assets/css');
    define('IMAGES', 'http://localhost/gitexplorelk/explorelk/public/assets/images');
    define('APPROOT',dirname(dirname(__FILE__)));


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
    
    
    