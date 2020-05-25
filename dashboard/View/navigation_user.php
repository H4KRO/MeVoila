<?php
function display_action_edit($id){
  echo '<form>';
  echo '<input type="hidden" name="controller" value="NavigationAdminController">';
  echo '<input type="hidden" name="method" value="edit">';
  echo '<input type="hidden" name="id" value="' . $id . '">';
  echo '<input type="submit" value="Modifier">';
  echo '</form>';
}
function display_action_delete($id){
  echo '<form>';
  echo '<input type="hidden" name="controller" value="NavigationAdminController">';
  echo '<input type="hidden" name="method" value="delete">';
  echo '<input type="hidden" name="id" value="' . $id . '">';
  echo '<input type="submit" value="Supprimer">';
  echo '</form>';
}
 ?>

<table>
  <tr>
    <th>Label</th>
    <th>Destination</th>
    <th>Langue</th>
    <th>Action</th>
  </tr>
<?php
foreach($menu_items as $item){
  echo '<tr>';
  echo '<td>' . $item->label . '</td>';
  echo '<td><a href="' . $item->destination . '">' . $item->destination . '</td>';
  echo '<td>' . $item->lang . '</td>';
  echo '<td>';
  display_action_edit($item->id);
  display_action_delete($item->id);
  echo '</td>';
  echo '</tr>';
}
?>
<form action="" method="get">
  <input type="hidden" name="controller" value="NavigationAdminController">
  <input type="hidden" name="method" value="create">
  <tr>
    <td><input type="text" name="key-label"></td>
    <td>
      <select name="key-destination">
        <option value="">Acceuil</option>
        <?php
        foreach($all_pages as $page){
          echo '<option value="' . $page->complete_url() . '">' . $page->title . ' - ' . $page->lang . '</option>';
        }
         ?>
      </select>
    </td>
    <td>
      <select name="key-lang">
        <option value="fr">Français</option>
        <option value="en">Anglais</option>
      </select>
    </td>
    <td>
      <input type="submit" value="Créer">
    </td>
  </tr>
</form>
<?php
 ?>
</table>
