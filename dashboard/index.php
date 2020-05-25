<?php

const APP_DIR = "../app/";
const DEFAULT_LANG = "fr";
const BASE_URL 		= "http://localhost/mevoila/";
const BASE_URL_DASHBOARD 		= "http://localhost/mevoila/dashboard";
const DB_LOCATION = APP_DIR . "Database/database.sqlite3";

require_once(APP_DIR . 'Database/database.php');
Database::init();


$files = scandir(APP_DIR . "Model/");
foreach($files as $file){
  if(strpos($file, '.php')){
    require_once(APP_DIR . "Model/" . $file);
  }
}

$files = scandir("Controller/");
foreach($files as $file){
  if(strpos($file, '.php')){
    require_once("Controller/" . $file);
  }
}

$controller = "MainAdminController";
$method = "index";
if(isset($_GET['controller']) && isset($_GET['method'])){
  if(method_exists($_GET['controller'], $_GET['method'])){
    $controller = $_GET['controller'];
    $method = $_GET['method'];
  }
}
$controller::$method();

 ?>
