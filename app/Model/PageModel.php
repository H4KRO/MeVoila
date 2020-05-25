<?php
class PageModel {
  static function getAll(){
    $sql = Database::get()->prepare("SELECT * FROM page;");
    $sql->execute();
    $pages = $sql->fetchAll(PDO::FETCH_CLASS, "PageModel");
    $sql->closeCursor();
    return $pages;
  }
  static function getAllByLang($lang){
    $sql = Database::get()->prepare("SELECT * FROM page WHERE lang = :lang;");
    $sql->execute(array(":lang" => $lang));
    $pages = $sql->fetchAll(PDO::FETCH_CLASS, "PageModel");
    $sql->closeCursor();
    return $pages;
  }
  static function get($id){
    $sql = Database::get()->prepare("SELECT * FROM page WHERE id = :id");
    $sql->execute(array(':id' => $id));
    $pages = $sql->fetchAll(PDO::FETCH_CLASS, "PageModel");
    $sql->closeCursor();
    if(sizeof($pages) > 0){
      return $pages[0];
    }else{
      return false;
    }
  }
  static function get_url($url){
    $lang = DEFAULT_LANG;
    if(isset($GLOBALS['URL_PARAMETERS']['lang'])){
      $lang = $GLOBALS['URL_PARAMETERS']['lang'];
    }
    $sql = Database::get()->prepare("SELECT * FROM page WHERE url = :url AND lang = :lang;");
    $sql->execute(array(':url' => $url, ":lang" => $lang));
    $pages = $sql->fetchAll(PDO::FETCH_CLASS, "PageModel");
    $sql->closeCursor();
    if(sizeof($pages) > 0){
      return $pages[0];
    }else{
      return false;
    }
  }
  static function getAllBase(){
    $sql = Database::get()->prepare("SELECT * FROM page");
    $sql->execute();
    $pages = $sql->fetchAll(PDO::FETCH_CLASS, "PageModel");
    $sql->closeCursor();
    return $pages;
  }
  function available_languages(){
    $langs = array();
    $sql = Database::get()->prepare("SELECT * FROM page WHERE id = :id OR traduction = :id OR id = :t_id OR traduction = :t_id;");
    $sql->execute(array(":id" => $this->id, ":t_id" => $this->traduction));
    $pages = $sql->fetchAll(PDO::FETCH_CLASS, "PageModel");
    $sql->closeCursor();
    return $pages;
  }
  function complete_url(){
    if($this->homepage){
      return BASE_URL . $this->lang . $this->url;
    }else{
      return BASE_URL . $this->lang . "/page/" . $this->url;
    }
  }
  function save(){
    $sql = Database::get()->prepare("UPDATE page SET title = :title, content = :content, traduction = :traduction WHERE id = :id");
    $sql->execute(array(":id" => $this->id, ":title" => $this->title, ":content" => $this->content, ":traduction" => $this->traduction));
    $sql->closeCursor();
  }
  function insert(){
    $sql = Database::get()->prepare("INSERT INTO page(title, url, lang, content) VALUES(:title, :url, :lang, :content)");
    $sql->execute(array(":title" => $this->title, ":url" => $this->url, ":lang" => $this->lang,  ":content" => $this->content));
    $sql->closeCursor();
  }
  function delete(){
    $sql = Database::get()->prepare("DELETE FROM page WHERE id = :id");
    $sql->execute(array(":id" => $this->id));
    $sql->closeCursor();
  }
  function generate_url(){
    $this->url = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->title)));
  }
}
 ?>
