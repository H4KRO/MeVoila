<?php

class MainController {
  static function index(){
    $view = "page";
    $page = PageModel::get(ParameterModel::get("main_page"));
    require_once('app/View/MainView.php');
  }
  static function not_found(){
    $view = "404";
    require_once('app/View/MainView.php');
  }
}
