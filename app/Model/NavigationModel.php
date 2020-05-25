<?php

class NavigationModel {
  static function getAll(){
    $sql = Database::get()->prepare("SELECT * FROM navigation WHERE parent IS NULL AND lang = :lang ORDER BY position ASC;");
    $lang = DEFAULT_LANG;
    if(isset($GLOBALS['URL_PARAMETERS']['lang'])){
      $lang = $GLOBALS['URL_PARAMETERS']['lang'];
    }
    $sql->execute(array(":lang" => $lang));
    $items = $sql->fetchAll(PDO::FETCH_CLASS, "NavigationModel");
    foreach($items as $item){
      $item->computeChildrens();
    }
    return $items;
  }

  static function getAllLanguages(){
    $sql = Database::get()->prepare("SELECT * FROM navigation WHERE parent IS NULL ORDER BY position ASC;");
    $sql->execute();
    $items = $sql->fetchAll(PDO::FETCH_CLASS, "NavigationModel");
    foreach($items as $item){
      $item->computeChildrens();
    }
    return $items;
  }

  static function get($id){
    $sql = Database::get()->prepare("SELECT * FROM navigation WHERE id = :id;");
    $sql->execute(array(":id" => $id));
    $items = $sql->fetchAll(PDO::FETCH_CLASS, "NavigationModel");
    return $items[0];
  }

  private function computeChildrens(){
    $sql = Database::get()->prepare("SELECT * FROM navigation WHERE parent = :parent AND lang = :lang ORDER BY position ASC;");
    $lang = DEFAULT_LANG;
    if(isset($GLOBALS['URL_PARAMETERS']['lang'])){
      $lang = $GLOBALS['URL_PARAMETERS']['lang'];
    }
    $sql->execute(array(":parent" => $this->id, ":lang" => $lang));
    $sql->closeCursor();
    $this->childrens = $sql->fetchAll(PDO::FETCH_CLASS, "NavigationModel");
    foreach($this->childrens as $children){
      $children->computeChildrens();
    }
  }

  function has_childrens(){
    return sizeof($this->childrens) >= 1;
  }

  function save(){
    $sql = Database::get()->prepare("UPDATE navigation SET label = :label, destination = :destination, lang = :lang WHERE id = :id;");
    $sql->execute(array(":label" => $this->label, ":destination" => $this->destination, ":lang" => $this->lang, ":id" => $this->id));
    $sql->closeCursor();
  }

  function insert(){
    $sql = Database::get()->prepare("INSERT INTO navigation (label, destination, lang) VALUES (:label, :destination, :lang)");
    $sql->execute(array(":label" => $this->label, ":destination" => $this->destination, ":lang" => $this->lang));
    $sql->closeCursor();
  }

  function delete(){
    $sql = Database::get()->prepare("DELETE FROM navigation WHERE id = :id");
    $sql->execute(array(":id" => $this->id));
    $sql->closeCursor();
  }
}
