<div class="hat_margin">
 <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
 <div>
  <div>
   <input type="hidden" value="editme" name="action" />
  </div>
  <div>
   <span class="names">Файл:</span>
   <span class="values"><?php echo $GALLERY[$imagekey]['filename']; ?></span>
  </div>
  <div>
   <span class="names">Назв.:</span>
   <span><input class="fields" name="newname" type="text" size="16" value="<?php echo $GALLERY[$imagekey]['name']; ?>"/></span>
  </div>
  <div>
   <span class="names">Дата:</span>
   <span><input class="fields" name="newdate" type="text" size="16" value="<?php echo $GALLERY[$imagekey]['date']; ?>"/></span>
  </div>
  <div>
   <span class="names">Автор:</span>
   <span><input class="fields" name="newauthor" type="text" size="16" value="<?php echo $GALLERY[$imagekey]['author']; ?>"/></span>
  </div>
  <div>
   <span class="names">&nbsp;</span>
   <span><input class="buttons" type="submit" value="Обновить" /></span>
  </div>
 </div>
 </form>
 
 <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
 <div>
  <div>
   <input type="hidden" value="deleteme" name="action" />
  </div>
  <div>
   <span class="names">&nbsp;</span>
   <span><input class="buttons" type="submit" value="Удалить" /></span>
  </div>
 </div>
 </form>
</div>