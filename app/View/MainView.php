
<?php
require_once('app/view/header.php');
require_once('app/view/nav.php');
if(isset($view) && file_exists('app/View/' . $view . '.php')){
  require_once('app/View/' . $view . '.php');
}else{
  require_once('app/View/404.php');
}
require_once('app/View/footer.php');
?>
