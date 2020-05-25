<?php

class ParameterModel {
  static function get($key){
    $sql = Database::get()->prepare("SELECT value FROM parameters WHERE key = :key;");
    $sql->execute(array(':key' => $key));
    $result = $sql->fetchAll();
    $sql->closeCursor();
    if(sizeof($result) > 0){
      return $result[0]['value'];
    }else{
      return false;
    }
  }
  static function getAll(){
    $sql = Database::get()->prepare("SELECT * FROM parameters;");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_CLASS, "ParameterModel");
    $sql->closeCursor();
    return $result;
  }
  static function getTemplates(){
    $template_dir = scandir(APP_DIR . 'View');
    $templates = array();
    foreach($template_dir as $template){
      if(!strpos($template, '.') && strlen($template) > 2){
        array_push($templates, $template);
      }
    }
    return $templates;
  }
  function update(){
    $sql = Database::get()->prepare("UPDATE parameters SET value = :value WHERE key = :key");
    $sql->execute(array(':key' => $this->key, ":value" => $this->value));
    $sql->closeCursor();
  }
}
