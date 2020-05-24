<?php

function get_lang(){
  if(isset($GLOBALS['URL_PARAMETERS']['lang'])){
    return $GLOBALS['URL_PARAMETERS']['lang'];
  }else{
    return DEFAULT_LANG;
  }
}

function display_link($destination, $label){
    echo "<a href=\"" . $destination . "\">" . $label . "</a>";
}

function display_menu($menu_items){
  echo "<ul>";
  foreach($menu_items as $item){
    echo "<li>";
    if(isset($item->destination)){
      display_link(BASE_URL . $item->destination, $item->label);
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
