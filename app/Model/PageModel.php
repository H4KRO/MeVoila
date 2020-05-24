<?php
class PageModel {
  static function getAll(){
    $sql = Database::get()->prepare("SELECT * FROM page;");
    $sql->execute();
    $pages = $sql->fetchAll(PDO::FETCH_CLASS, "PageModel");
    return $pages;
  }
  static function get($id){
    $sql = Database::get()->prepare("SELECT * FROM page WHERE id = :id");
    $sql->execute(array(':id' => $id));
    $pages = $sql->fetchAll(PDO::FETCH_CLASS, "PageModel");
    return $pages[0];
  }
  static function get_url($url){
    $lang = DEFAULT_LANG;
    if(isset($GLOBALS['URL_PARAMETERS']['lang'])){
      $lang = $GLOBALS['URL_PARAMETERS']['lang'];
    }
    $sql = Database::get()->prepare("SELECT * FROM page WHERE url = :url AND lang = :lang;");
    $sql->execute(array(':url' => $url, ":lang" => $lang));
    $pages = $sql->fetchAll(PDO::FETCH_CLASS, "PageModel");
    if(sizeof($pages) > 0){
      return $pages[0];
    }else{
      return false;
    }
  }
  function available_languages(){
    $langs = array();
    $sql = Database::get()->prepare("SELECT * FROM page WHERE id = :id OR traduction = :id OR id = :t_id OR traduction = :t_id;");
    $sql->execute(array(":id" => $this->id, ":t_id" => $this->traduction));
    $pages = $sql->fetchAll(PDO::FETCH_CLASS, "PageModel");
    return $pages;
  }
  function complete_url(){
    if($this->homepage){
      return BASE_URL . $this->lang . $this->url;
    }else{
      return BASE_URL . $this->lang . "/page/" . $this->url;
    }
  }
}
 ?>
