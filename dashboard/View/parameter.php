<form class="" action="?controller=ParameterAdminController&method=save" method="get">
  <?php
  echo "<input type=\"hidden\" name=\"controller\" value=\"ParameterAdminController\">";
  echo "<input type=\"hidden\" name=\"method\" value=\"save\">";
  echo "<ul>";
  foreach($parameters_array as $parameter){
    echo "<li>";
    echo "<label for=\"key-" . $parameter->key . "\">" . $parameter->key . "</label>";
    switch($parameter->type){

      case "text":
        echo '<textarea name="key-' . $parameter->key . '">' . $parameter->value . '</textarea>';
        break;

      case "page":
        echo '<select type="text" name="key-' . $parameter->key . '">';
        foreach($pages_array as $page){
          if($page->id == $parameter->value){
            echo '<option value="' . $page->id . '" selected>' . $page->title . ' - ' . $page->lang . '</option>';
          }else{
            echo '<option value="' . $page->id . '">' . $page->title . ' - ' . $page->lang . '</option>';
          }
        }
        echo '</select>';
        break;

        case "template":
          echo '<select type="text" name="key-' . $parameter->key . '">';
          foreach($templates as $template){
            if($template == ParameterModel::get("template")){
              echo '<option value="' . $template . '" selected>' . $template . '</option>';
            }else{
              echo '<option value="' . $template . '">' . $template . '</option>';
            }
          }
          echo '</select>';
          break;

      default:
        echo '<input type="text" name="key-' . $parameter->key . '" value="' . $parameter->value . '">';
    }
    echo "</li>";
  }
  echo '<li><input type="submit" value="Sauvegarder"></li>';
  echo "</ul>";
   ?>
</form>
