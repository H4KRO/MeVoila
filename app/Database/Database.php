<?php

class Database {
  private static $db;
  static function init(){
    $db = new SQlite3(DB_LOCATION);
  }
  static function get(){
    return $db;
  }
}
