<?php
class PageAdminController {
  static function main() {
    $pages = PageModel::getAllBase();
    $view = "page";
    require_once('View/MainView.php');
  }
  static function edit(){
  if(isset($_GET['id'])){
    $page = PageModel::get($_GET['id']);
    $all_pages = PageModel::getAll();
    $view = "page_edit";
  }else{
    $view = "page";
  }
  require_once('View/MainView.php');
  }
  static function save(){
    if(isset($_GET['id'])){
      $page = PageModel::get($_GET['id']);
      $page->title = $_GET['key-title'];
      $page->content = $_GET['key-content'];
      $page->traduction = $_GET['key-traduction'];
      $page->save();
      self::edit();
    }else{
      self::main();
    }
  }

  static function create(){
    $page = new PageModel();
    $page->title = $_GET['key-title'];
    $page->lang = $_GET['key-lang'];
    $page->content = " ";
    $page->generate_url();
    $page->insert();
    $page->id = Database::get()->lastInsertId();
    $page->traduction = $page->id;
    $page->save();
    self::main();
  }
  static function delete(){
    $page = PageModel::get($_GET['id']);
    $page->delete();
    $view = "page";
    $pages = PageModel::getAllBase();
    require_once('View/MainView.php');
  }
}
 ?>
