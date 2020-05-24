
<?php
$template_path = "View/";
require_once('View/header.php');
if(isset($view) && file_exists($template_path . $view . '.php')){
  require_once('View/' . $view . '.php');
}else{
  require_once('View/' . '404.php');
}
require_once('View/' . 'footer.php');
?>
