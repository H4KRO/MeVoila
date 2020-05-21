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

  private function computeChildrens(){
    $sql = Database::get()->prepare("SELECT * FROM navigation WHERE parent = :parent AND lang = :lang ORDER BY position ASC;");
    $lang = DEFAULT_LANG;
    if(isset($GLOBALS['URL_PARAMETERS']['lang'])){
      $lang = $GLOBALS['URL_PARAMETERS']['lang'];
    }
    $sql->execute(array(":parent" => $this->id, ":lang" => $lang));
    $this->childrens = $sql->fetchAll(PDO::FETCH_CLASS, "NavigationModel");
    foreach($this->childrens as $children){
      $children->computeChildrens();
    }
  }

  function has_childrens(){
    return sizeof($this->childrens) >= 1;
  }
}
