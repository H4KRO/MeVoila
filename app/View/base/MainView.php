
<?php
require_once($template_path . 'helper.php');
require_once($template_path . 'header.php');
if(isset($view) && file_exists($template_path . $view . '.php')){
  require_once($template_path . $view . '.php');
}else{
  require_once($template_path . '404.php');
}
require_once($template_path . 'footer.php');
?>
