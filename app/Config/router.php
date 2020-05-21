<?php

require_once("app/Controller/MainController.php");
require_once("app/Controller/PageController.php");
require_once("app/Controller/BlogController.php");
require_once("app/Controller/PortfolioController.php");

class Route {
  function __construct($controller, $method){
    $this->controller = $controller;
    $this->method = $method;
  }
  function exec(){
    if(method_exists($this->controller, $this->method)){
      $ctrl = $this->controller;
      $mthd = $this->method;
      $ctrl::$mthd();
    }else{
      MainController::not_found();
    }
  }
}

function route($controller, $method){
  return new Route($controller, $method);
}

function get_path($path){

  $root_path = ROOT_DOCUMENT;
  $root_path = explode('/', $root_path);
  $root_path = array_diff($root_path, array(''));
  $root_path = array_values($root_path);

  $path = explode('?', $path)[0];
  $path = explode('/', $path);
  $path = array_diff($path, array(''));
  $path = array_diff($path, $root_path);
  $path = array_values($path);
  return $path;
}

function compare_path($path, $path_req){
  $path = get_path($path);
  $path_req = get_path($path_req);

  $min = min(array(sizeof($path), sizeof($path_req)));
  $max = max(array(sizeof($path), sizeof($path_req)));

  if($min != $max){
    return $min = 0;
  }

  $parameters = array();

  for($i = 0; $i < $min; $i++){
    if($path[$i] != $path_req[$i] && $path[$i][0] != "*"){
      return false;
    }
  }

  return true;
}

function set_parameters($path, $path_req){
  $GLOBALS['URL_PARAMETERS'] = array();
  $path = get_path($path);
  $path_req = get_path($path_req);
  for($i = 0; $i < sizeof($path); $i++){
    if($path[$i][0] == "*" && strlen($path[$i]) > 1){ 
      $GLOBALS['URL_PARAMETERS'][substr($path[$i], 1)] = $path_req[$i];
    }
  }
}

function exec_route($routes_array){
  foreach($routes_array as $route => $controller_method){
    if(compare_path($route, $_SERVER['REQUEST_URI'])){
      set_parameters($route, $_SERVER['REQUEST_URI']);
      $controller_method->exec();
      return;
    }
  }
  MainController::not_found();
}
