
<?php


// front controller

 ini_set ('display_errors',1);
  error_reporting(E_ALL);


  // підключення файлів
  define('ROOT', dirname(__FILE__));
  require_once (ROOT.'/components/Router.php');


//echo phpinfo();
  // виклик роутера
$router = new Router();
$router ->run();



