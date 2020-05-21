<?php

class Database {
  static $db;
  static function init(){
    try{
      self::$db = new PDO('sqlite:' . DB_LOCATION);
      self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE_WARNING | ERRMODE_EXCEPTION | ERRMODE_SILENT
    } catch(Exception $e) {
        echo "Impossible d'accéder à la base de données SQLite : ".$e->getMessage();
        die();
    }
  }
  static function get(){
    return self::$db;
  }
}
