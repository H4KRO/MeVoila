<?php
class UserModel{
  static function getAll(){
    $sql = Database::get()->prepare("SELECT * FROM user;");
    $sql->execute();
    $users = $sql->fetchAll(PDO::FETCH_CLASS, "UserModel");
    return users;
  }
}
 ?>
