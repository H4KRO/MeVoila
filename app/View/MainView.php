<?php
$template = "default";
if(ParameterModel::get("template")){
  $template = ParameterModel::get("template");
}
$template_path = "app/View/" . $template . "/";
require_once($template_path . "MainView.php");
 ?>
