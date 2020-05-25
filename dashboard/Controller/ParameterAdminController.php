<?php
class ParameterAdminController {
  static function main(){
    $parameters_array = ParameterModel::getAll();
    $pages_array = PageModel::getAll();
    $templates = ParameterModel::getTemplates();
    $view = "parameter";
    require_once('View/MainView.php');
  }

  static function save(){
    $parameters_array = ParameterModel::getAll();
    foreach($parameters_array as $parameter){
      if(isset($_GET['key-' . $parameter->key]) && $parameter->value != $_GET['key-' . $parameter->key]){
        $parameter->value = $_GET['key-' . $parameter->key];
        $parameter->update();
      }
    }
    self::main();
  }
}
 ?>
