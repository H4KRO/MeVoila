<?php
echo "<h1>" . $page->title . "</h1>";
echo "<p>" . $page->content . "</p>";
$translations = $page->available_languages();
foreach($translations as $translation){
  if($page->lang != $translation->lang){
    display_link($translation->complete_url(), $translation->lang);
  }
}
 ?>
