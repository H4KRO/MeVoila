<?php

class MainController {
  static function index(){
    $view = "page";
    $page = PageModel::get(ParameterModel::get("main_page"));
    if(isset($GLOBALS['URL_PARAMETERS']['lang'])){
      foreach($page->available_languages() as $page_lang){
        if($page_lang->lang == $GLOBALS['URL_PARAMETERS']['lang']){
          $page = $page_lang;
          break;
        }
      }
    }
    require_once('app/View/MainView.php');
  }
  static function not_found(){
    $view = "404";
    require_once('app/View/MainView.php');
  }
}
