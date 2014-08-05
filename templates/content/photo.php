<!-- Форма отображения фотографии в галерии -->
<table id="photo_display">
 <tr id="photo_display_bottom_border">
  <td>
   <div id="photo_display_left_button_cell"><a class="link" href="?img=<?php getPrevious($GALLERY) ?>">Предыдущая</a></div>
   <div id="photo_display_index_button_cell"><a class="link" href="index.php">Галерея</a></div>
   <div id="photo_display_right_button_cell"><a class="link" href="?img=<?php getNext($GALLERY) ?>">Следующая</a></div>
  </td>
 </tr>
 <tr>
  <td>
   <img id="photo_display_image" alt="<?php print $curr['name']; ?>" src="./gallery/pictures/<?php print $img; ?>" style="width: <?php print $photo_width; ?>px; height: <?php print $photo_height; ?>px;" />
  </td>
 </tr>
 <tr id="photo_display_top_border">
  <td>
  <div>
   <div class="photo_display_info_lineblock">
    <span class="photo_display_info_names">Название:</span>
    <span class="photo_display_info_values">&nbsp;<?php print $curr['name']; ?></span>
   </div>
   <div class="photo_display_info_lineblock">
    <span class="photo_display_info_names">Автор:</span>
    <span class="photo_display_info_values">&nbsp;<?php print $curr['author']; ?></span>
   </div>
   <div class="photo_display_info_lineblock">
    <span class="photo_display_info_names">Добавлено:</span>
    <span class="photo_display_info_values">&nbsp;<?php print $curr['date']; ?></span>
   </div>
  </div>
  </td>
 </tr>
 <tr>
  <td>
   <div id="comm_whole_block">
    <?php ShowComments($comm_xpath, $imgnojpg); ?>
    <?php include('./templates/content/comment_form.php'); ?>
   </div>
  </td>
 </tr>
</table>
<!-- Форма отображения фотографии в галерии, конец -->

