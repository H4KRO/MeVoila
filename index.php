<?php
require_once('app/config/config.php');
require_once('app/Database/Database.php');
Database::init();

require_once('app/config/router.php');
const APP_DIR = "app/";
$files = scandir(APP_DIR . "Model/");
foreach($files as $file){
  if(strpos($file, '.php')){
    require_once(APP_DIR . "Model/" . $file);
  }
}

$files = scandir(APP_DIR . "Controller/");
foreach($files as $file){
  if(strpos($file, '.php')){
    require_once(APP_DIR . "Controller/" . $file);
  }
}

$routes = array(
  "/" => route("MainController", "index"),
  "/*lang/" => route("MainController", "index"),
  "/*lang/page/" => route("PageController", "main"),
  "/page/" => route("PageController", "main"),
  "/*lang/page/*page/" => route("PageController", "page"),
  "/page/*page/" => route("PageController", "page")
);

exec_route($routes);
