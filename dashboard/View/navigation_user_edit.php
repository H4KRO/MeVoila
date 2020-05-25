<form action="" method="get">
  <input type="hidden" name="controller" value="NavigationAdminController">
  <input type="hidden" name="method" value="save">
  <input type="hidden" name="id" value="<?php echo $navigation->id; ?>">
  <ul>
    <li>
      <label for="key-label">Label</label>
      <input type="text" name="key-label" value="<?php echo $navigation->label ?>">
    </li>
    <li>
      <label for="key-destination">Destination</label>
      <select name="key-destination">
        <option value="">Acceuil</option>
        <?php
        foreach($pages as $page){
          echo '<option value="' . $page->complete_url() . '">' . $page->title . ' - ' . $page->lang . '</option>';
        }
         ?>
      </select>
    </li>
    <li>
      <label for="key-lang">Langue</label>
      <select name="key-lang">
        <option value="fr">Français</option>
        <option value="en">Anglais</option>
      </select>
    </li>
    <li>
      <input type="submit" value="Enregistrer">
    </li>
  </ul>
</form>
