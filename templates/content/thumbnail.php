<!-- Форма отображения тумбнайлов в галерии -->
<div class="thumb_float">
<table>
 <tr>
  <td class="thumb_centering">

  <table class="thumb_table">
   <tr>
    <td>
     <a href="?img=<?php print $current_array['filename']; ?>"><img class="thumb_image" alt="<?php print $current_array['name']; ?>" src="./gallery/thumbs/<?php print $current_array['filename']; ?>" /></a>
    </td>
   </tr>
   <tr>
    <td>
     <div class="thumb_name" style="width: <?php print $width; ?>;"><?php print $current_array['name']; ?></div>
     <div class="thumb_comms"><?php print $number_of_comments; ?></div>
     <img class="thumb_pencil" alt="Комментарии" src="./img/pencil.png" />
    </td>
   </tr>
  </table>
  
  </td>
 </tr>
</table>
</div>
<!-- Форма отображения тумбнайлов в галерии, конец -->

