<!-- Форма добавления комментариев -->
<div>
 <?php $comm_setid = date("yzHis").rand(0,9); ?>
 <form method="post" action="<?php echo $_SERVER['REQUEST_URI'].'#'.$comm_setid; ?>">
  <div>
   <input type="hidden" name="id" value="<?php echo $comm_setid ; ?>" />
   <input type="hidden" name="comment" value="post_it" />
   <input type="hidden" name="postable_image" value="<?php echo $imgnojpg; ?>" />
  </div>  
  <table id="comm_add_form_table">
   <tr>
    <td id="comm_add_form_cell">
     <div class="comm_add_form_lineblocks">
      <span class="comm_add_form_names">Имя</span>
      <span><input class="comm_add_form_fields" name="name" type="text" size="20" value="<?php echo $_SESSION['name']; ?>" /></span>
     </div>
     <div class="comm_add_form_lineblocks">
      <span class="comm_add_form_names">Комментарий</span>
      <span><textarea class="comm_add_form_fields" name="text" cols="30" rows="3"></textarea></span>
     </div>
     <div class="comm_add_form_lineblocks">
      <span class="comm_add_form_names">&nbsp;</span>    
      <span>
      <input class="comm_add_form_buttons" type="submit" value="Комментировать" />
      <span id="comm_add_form_status"><?php echo $post_status; ?></span>
      </span>    
     </div>
    </td>
   </tr>
  </table>
 </form>
</div>
<!-- Форма добавления комментариев, конец -->

