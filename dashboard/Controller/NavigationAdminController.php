<?php
class NavigationAdminController {
  static function main(){
    $menu_items = NavigationModel::getAllLanguages();
    $all_pages = PageModel::getAll();
    $view = "navigation_user";
    require_once('View/MainView.php');

  }
  static function edit(){
    $navigation = NavigationModel::get($_GET['id']);
    $pages = PageModel::getAllByLang($navigation->lang);
    $view = "navigation_user_edit";
    require_once('View/MainView.php');
  }
  static function save(){
    $navigation = NavigationModel::get($_GET['id']);
    $navigation->label = $_GET['key-label'];
    $navigation->destination = $_GET['key-destination'];
    $navigation->lang = $_GET['key-lang'];
    $navigation->save();
    self::edit();
  }
  static function create(){
    $navigation = new NavigationModel();
    $navigation->label = $_GET['key-label'];
    $navigation->destination = $_GET['key-destination'];
    $navigation->lang = $_GET['key-lang'];
    $navigation->insert();
    self::main();
  }
  static function delete(){
    $navigation = NavigationModel::get($_GET['id']);
    $navigation->delete();
    self::main();
  }
}
 ?>
