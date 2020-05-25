<a href="<?php  echo $page->complete_url() ?>" target="_blank">Voir sur le site</a>

<form id="edit-form" action="" method="get">
<ul>
  <input type="hidden" name="controller" value="PageAdminController">
  <input type="hidden" name="method" value="save">
  <input type="hidden" name="id" value="<?php echo $page->id; ?>">
  <li><label for="key-title">Title</label><input type="text" name="key-title" value="<?php echo $page->title ?>"></li>

  <li>
    <label for="key-traduction">Traduction</label>
    <select name="key-traduction">
      <?php
      foreach($all_pages as $other_page){
        if($other_page->id == $page->traduction){
          echo '<option value="' . $page->id . '" selected>' . $other_page->title . ' - ' . $other_page->lang . '</option>';
        }else{
          echo '<option value="' . $other_page->id . '">' . $other_page->title . ' - ' . $other_page->lang . '</option>';
        }
      }
       ?>
    </select>
  </li>
  <input type="hidden" id="edit-content" name="key-content" value="test">
  <div id="editor"><?php echo $page->content; ?></div>
  <li><input type="submit" value="Enregistrer"></li>
</ul>
</form>

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.20.0/trumbowyg.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.20.0/ui/trumbowyg.min.css">
<script>
$('#editor').trumbowyg();

$('#edit-form').submit(function() {
  document.getElementById("edit-content").value = document.getElementById("editor").innerHTML;
  return true;
});

</script>
