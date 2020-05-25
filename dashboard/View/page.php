<?php
function display_action_edit($id){
  echo '<form>';
  echo '<input type="hidden" name="controller" value="PageAdminController">';
  echo '<input type="hidden" name="method" value="edit">';
  echo '<input type="hidden" name="id" value="' . $id . '">';
  echo '<input type="submit" value="Modifier">';
  echo '</form>';
}
function display_action_delete($id){
  echo '<form>';
  echo '<input type="hidden" name="controller" value="PageAdminController">';
  echo '<input type="hidden" name="method" value="delete">';
  echo '<input type="hidden" name="id" value="' . $id . '">';
  echo '<input type="submit" value="Supprimer">';
  echo '</form>';
}
 ?>

<table>
  <tr>
    <th>Titre</th>
    <th>Langue</th>
    <th>Actions</th>
  </tr>
    <?php
    foreach($pages as $page){
      echo '<tr>';
      echo '<td>' . $page->title . '</td>';
      echo '<td>' . $page->lang . '</td>';
      echo '<td>';
      display_action_edit($page->id);
      display_action_delete($page->id);
      echo '</td>';
      echo '</tr>';
    }
     ?>
     <tr>
       <!-- Modifier -->
       <form action="" method="get">
         <input type="hidden" name="controller" value="PageAdminController">
         <input type="hidden" name="method" value="create">
         <td>
           <input type="text" name="key-title" value="Article sans nom">
         </td>
         <td>
           <select name="key-lang">
             <option value="fr" selected>Français</option>
             <option value="en" selected>Anglais</option>
           </select>
         </td>
         <td>
           <input type="submit" value="Ajouter">
         </td>
       </form>
     </tr>
</table>
