<?php

class ParameterModel {
  static function get($key){
    $sql = Database::get()->prepare("SELECT value FROM parameters WHERE key = :key;");
    $sql->execute(array(':key' => $key));
    $result = $sql->fetchAll();
    if(sizeof($result) > 0){
      return $result[0]['value'];
    }else{
      return "Unknow parameter " . $key . ".";
    }
  }
}
