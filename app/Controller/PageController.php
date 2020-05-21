<?php

class PageController {
  static function main(){
    $view = "page";
    $page = PageModel::get(ParameterModel::get("main_page"));
    require_once('app/View/MainView.php');
  }
  static function page(){
    $view = "page";
    $page = PageModel::get_url($GLOBALS['URL_PARAMETERS']['page']);
    if(!$page){
      $view = "404";
    }else{
      $view = "page";
    }
    require_once('app/View/MainView.php');
  }
}
