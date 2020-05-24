<?php

function get_lang(){
  if(isset($GLOBALS['URL_PARAMETERS']['lang'])){
    return $GLOBALS['URL_PARAMETERS']['lang'];
  }else{
    return DEFAULT_LANG;
  }
}

function is_active($destination){
  $dest = $destination;
  $req =  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . explode("?", $_SERVER['REQUEST_URI'])[0];
  return $dest == $req;
}

function display_menu_link($destination, $label){
    if(is_active($destination)){
      echo "<a class=\"active\" href=\"" . $destination . "\">" . $label . "</a>";
    }else{
      echo "<a href=\"" . $destination . "\">" . $label . "</a>";
    }
}

function display_menu($menu_items){
  echo "<ul>";
  foreach($menu_items as $item){
    echo "<li>";
    if(isset($item->destination)){
      display_menu_link(BASE_URL . $item->destination, $item->label);
    }else{
      echo $item->label;
    }
    if($item->has_childrens()){
      display_menu($item->childrens);
    }
  }
  echo "</ul>";
}
 ?>
